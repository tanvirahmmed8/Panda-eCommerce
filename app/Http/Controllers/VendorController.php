<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function vendor_order($id){
        $invoices = Invoice::with(['invoice_detail_rel' => function($q){
            $q->with('product');
        }])->where('vendor_id', auth()->id())->get();
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
}
