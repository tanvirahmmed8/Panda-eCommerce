<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Team;
use App\Models\Brand;
use App\Models\Policy;
use App\Models\Invoice;
use App\Models\Product;
use Khsing\World\World;
use App\Models\Category;
use App\Models\Inventory;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use App\Models\Invoice_detail;
use Khsing\World\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForntendController extends Controller
{
    public function index(){
        $categories = Category::all();
        $brands = Brand::where('status', 'active')->get();
        $policeis = Policy::where('status', 'active')->get();
        //$products = Product::limit(6)->get();
        $latest_products = Product::limit(8)->latest()->get();
        $new_products = Product::limit(4)->latest()->get();
        $inventories = Inventory::all();
        $random = Product::inRandomOrder()->limit(1)->get();

        // best sell Category start
         $top_sales_cat = DB::table('products')
            ->leftJoin('invoice_details','products.id','=','invoice_details.product_id')
            ->selectRaw('products.category_id, SUM(invoice_details.quantity) as total')
            ->groupBy('products.category_id')
            ->orderBy('total','desc')
            ->take(6)
            ->get();
        $topcats = [];
        foreach ($top_sales_cat as $cc){
            $cat = Category::findOrFail($cc->category_id);
            $cat->totalQty = $cc->total;
            $topcats[] = $cat;
        }
        //return $topcats; //compact
        // best sell Category end

        // best sell product start

        $top_sales = DB::table('products')
            ->leftJoin('invoice_details','products.id','=','invoice_details.product_id')
            ->selectRaw('products.id, SUM(invoice_details.quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(9)
            ->get();
        $products = [];
        foreach ($top_sales as $s){
            $p = Product::findOrFail($s->id);
            $p->totalQty = $s->total;
            $products[] = $p;
        }
        // return $topProducts; //compact

        // best sell product end
        return view('frontend.index', compact('random','new_products','topcats','categories','brands','policeis','products','inventories','latest_products'));
    }
    public function cart(){
        return view('frontend.cart');
    }
    public function getcitylist(Request $request){
        $countries = Country::getByCode($request->billing_country);
        $cities = $countries->children();
        foreach ($cities as $city) {
           echo "<option value='$city->id'>$city->name</option>";
        }
    }
    public function checkout(){
        $last_url = explode('/', url()->previous());
        if (end($last_url) == 'cart') {
            $countries = World::Countries();
            return view('frontend.checkout', compact('countries'));
        } else {
           abort(404);
        }



    }
    public function checkoutpost(Request $request){
        //  return Cart::where('user_id', auth()->id())->first()->vendor_id;
        if (session('coupon')) {
            $coupon = session('coupon')->coupon_code;
        }else{
            $coupon = NULL;
        }
        $invoice_id = Invoice::insertGetId([
            'user_id' => auth()->id(),
            'vendor_id' => Cart::where('user_id', auth()->id())->first()->vendor_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_country' => $request->customer_country,
            'customer_city' => $request->customer_city,
            'customer_address' => $request->customer_address,
            'order_comments' => $request->order_comments,
            'payment_method' => $request->payment_method,
            'coupon' => $coupon,
            'subtotal' => session('subtotal'),
            'delivery_charge' => session('delivery_charge'),
            'total_price' => session('total_price'),
            'created_at' => Carbon::now()
        ]);
        session(['invoice_id' => $invoice_id]);
        foreach (Cart::where('user_id', auth()->id())->get() as $cart) {
            // return $cart;
            if (Product::find($cart->product_id)->discounted_price) {
                $unit_price = Product::find($cart->product_id)->discounted_price;
            } else {
               $unit_price = Product::find($cart->product_id)->regular_price;
            }

            Invoice_detail::insert([
                'invoice_id' => $invoice_id,
                'product_id' => $cart->product_id,
                'size_id' => $cart->size_id,
                'color_id' => $cart->color_id,
                'quantity' => $cart->quantity,
                'unit_price' => $unit_price,
                'created_at' => Carbon::now()
            ]);

            Inventory::where([
                'product_id' => $cart->product_id,
                'size_id' => $cart->size_id,
                'color_id' => $cart->color_id
            ])->decrement('quantity', $cart->quantity);

            $cart->delete();
        };

        if ($request->payment_method == 'COD') {
            return redirect('cart')->with('success', 'Yor Order Successfully Done!');
        }elseif($request->payment_method == 'SSL') {
            return redirect('pay')->with('price', session('total_price'));
        }elseif($request->payment_method == 'stripe'){
            return redirect('stripe')->with('price', session('total_price'));
        }else{
            abort(404);
        }

    }

    public function about(){
        return view('frontend.about');
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function login_register(){
        return view('frontend.login_register');
    }
    function team(){
        $teams = Team::paginate(5);
        $teams_count = Team::count();
        $deleted_team = Team::onlyTrashed()->get();
        return view('index', compact('teams', 'teams_count', 'deleted_team'));
       }

        function teampost(Request $request){
            //$request->name;
          Team::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'created_at' => Carbon::now()
          ]);
          return back()->with('success', 'Team member Added Successfully!');
       }
        public function contact_post(Request $request){
            $request->validate([
                '*' => 'required',
                'email' => 'email'
            ]);
            Mail::to('tanvir@live.com')->send(new ContactMessage($request->except('_token')));
            //name email subject message
            return back()->with('success', 'Your message send Successfully!');
       }

       function teamedit($id){
        $data = Team::find($id);
        return view('teamedit', compact('data'));
       }

       function teamupdate(Request $request, $id){
            // return $request;
            Team::find($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email
                // 'created_at' => Carbon::now()
            ]);
            return redirect('team')->with('delete_massege', 'Team member Updateed Successfully!');
       }

       function teamdelete($id){
            //return $id;
            if ($id == 'all') {
                Team::where('deleted_at', NULL)->delete();
                return back()->with('delete_massege', 'All Team member Deleted Successfully!');
            }else{
                Team::find($id)->delete();
                return back()->with('delete_massege', 'Team member Deleted Successfully!');
            }

       }

       function teamrestore($id){
        if ($id == 'all') {
            Team::onlyTrashed()->restore();
            return back();
        }else{
            Team::onlyTrashed()->where('id', $id)->restore();
            return back();
       }
    }

    function teamforcedelete($id){
        Team::onlyTrashed()->where('id', $id)->forceDelete();
        return back();
    }
    function single_product($id){
        $product = Product::find($id);
        $related_product = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->limit(6)->get();
        $inventories = Inventory::all();
        return view('frontend.single_product',compact('product','related_product','inventories'));
    }


}
