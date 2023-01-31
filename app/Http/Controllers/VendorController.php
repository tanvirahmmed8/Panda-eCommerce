<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductPromotion;
use App\Models\Withdraw;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VendorController extends Controller
{
    public function vendor_registration(){
        return view('frontend.vendor.registration');
    }
    public function vendor_registration_post(Request $request){

        $request->validate([
            '*' => 'required',
            'password' => 'confirmed|min:8',
            'email' => 'unique:users|email',

        ]);
        // User::insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone_number' => $request->phone_number,
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'password' => bcrypt($request->password),
        //     'role' => 'vendor',
        //     'action' => false
        // ]);

        User::insert($request->except('_token','password','password_confirmation')+[
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'password' => bcrypt($request->password),
            'role' => 'vendor',
            'action' => false
        ]);
        return back()->with('success', 'Your account created succesfully!');
    }

    public function vendor_login(){
        return view('frontend.vendor.login');
    }
    public function trash(){
        $trash_products = Product::onlyTrashed()
        ->where('vendor_id', auth()->id())
        ->get();
        return view('dashboard.vendor.trash', compact('trash_products'));
    }
    public function vendor_order($id){
        $invoices = Invoice::with(['invoice_detail_rel' => function($q){
            $q->with('product');
        }])->where('vendor_id', auth()->id())->where('order_status', '!=', 'deleverd')->get();
        return view('dashboard.vendor.order', compact('invoices'));
    }

    public function order_status(Request $request,$id)
    {
        Invoice::find($id)->update([
            'order_status' => $request->order_status
        ]);
        if($request->order_status == 'deleverd') {
            if(Invoice::find($id)->payment_method == 'COD') {
                Invoice::find($id)->update([
                    'payment_status' => 'paid'
                ]);
            }
        }
        return back();
    }

    public function vendor_login_post(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (User::where('email', $request->email)->exists()) {
           if (User::where('email', $request->email)->first()->role == "vendor") {
                if (User::where('email', $request->email)->first()->action == true) {
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        return redirect('home');
                    }else{
                        return back()->withErrors('Oops Invalid Email or Password!');
                    }
                }else{
                    return back()->withErrors('You account is not approved yet');
                }

           }else{
                return back()->withErrors('You are not a vendor.');
           }
        }else{
            return back()->withErrors('You are not registered');
        }
    }

    public function vendor_wallet()
    {
        $invoices = Invoice::where([
            'vendor_id'=> auth()->id(),
            'payment_status' => 'paid',
            'order_status' => 'deleverd'
        ])->where('withdrawal_status', '!=', 'Withdrawal Done')->get();
        $invoice_dones = Invoice::where([
            'vendor_id'=> auth()->id(),
            'payment_status' => 'paid',
            'order_status' => 'deleverd',
            'withdrawal_status' => 'Withdrawal Done'
        ])->get();
        return view('dashboard.vendor.wallet', compact('invoices','invoice_dones'));
    }

    public function vendor_withdraw(Request $request)
    {
        $invoices = Invoice::whereIn('id', $request->invoices)->get();
        return view('dashboard.vendor.wallet_withdraw', compact('invoices'));
    }
    public function withdraw_request(Request $request)
    {
       $invoice_ids =explode(',', rtrim(ltrim($request->invoices, '['), ']'));
       foreach($invoice_ids as $invoice_id){
        Withdraw::insert([
            'invoice_id' => $invoice_id,
            'vendor_id' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        Invoice::find($invoice_id)->update([
            'withdrawal_status' => 'Withdrawal request send'
        ]);
       }
        return redirect('/vendor/wallet');
    }

    public function applyforpromotion(Product $product)
    {
        $promotions = ProductPromotion::where('vendor_id', auth()->id())->get();
        return view('dashboard.vendor.applyforpromotion',compact('product','promotions'));
    }
    public function apply_banner(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg'

        ]);
        $new_name = Str::random(5, 9).'_'.auth()->id().'_'.time().'.'.$request->file('image')->getClientOriginalextension();
        $img = Image::make($request->file('image'))->resize(844, 517);
        $img->save(base_path('public/dashboard/uplaods/banner/'.$new_name), 100);

        ProductPromotion::insert([
            'product_id' => $request->product_id,
            'vendor_id' => auth()->id(),
            'short_title' => $request->short_title,
            'short_description' => $request->short_description,
            'image' => $new_name,
            'type' => 'banner',
            'created_at' => Carbon::now()
        ]);

        return back();

    }

    public function apply_promotion(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'p_image' => 'image|mimes:jpg,png,jpeg,gif,svg'

        ]);
        $new_name = Str::random(5, 9).'_'.auth()->id().'_'.time().'.'.$request->file('p_image')->getClientOriginalextension();
        $img = Image::make($request->file('p_image'))->resize(377, 348);
        $img->save(base_path('public/dashboard/uplaods/banner/'.$new_name), 100);

        ProductPromotion::insert([
            'product_id' => $request->product_id,
            'vendor_id' => auth()->id(),
            'short_description' => $request->p_short_description,
            'image' => $new_name,
            'type' => 'promotion',
            'created_at' => Carbon::now()
        ]);

        return back();

    }
}
