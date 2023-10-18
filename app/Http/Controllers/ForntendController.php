<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\Policy;
use App\Models\Product;
use App\Models\ProductPromotion;
use App\Models\ProductViewCount;
use App\Models\ResentlyViewProduct;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Khsing\World\Models\Country;
use Khsing\World\World;

class ForntendController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::where('status', 'active')->get();
        $policeis = Policy::where('status', 'active')->get();
        //$products = Product::limit(6)->get();
        $latest_products = Product::with('ratings')->limit(8)->latest()->get();
        $new_products = Product::with('stock')->limit(4)->latest()->get();
        // $inventories = Inventory::all();
        $random = Product::inRandomOrder()->limit(1)->get();

        // best sell Category start
        $top_sales_cat = DB::table('products')
           ->leftJoin('invoice_details', 'products.id', '=', 'invoice_details.product_id')
           ->selectRaw('products.category_id, SUM(invoice_details.quantity) as total')
           ->groupBy('products.category_id')
           ->orderBy('total', 'desc')
           ->take(6)
           ->get();
        $topcats = [];
        foreach ($top_sales_cat as $cc) {
            $cat = $categories->find($cc->category_id);
            $cat->totalQty = $cc->total;
            $topcats[] = $cat;
        }
        //return $topcats; //compact
        // best sell Category end

        // best sell product start

        $top_sales = DB::table('products')
            ->leftJoin('invoice_details', 'products.id', '=', 'invoice_details.product_id')
            ->selectRaw('products.id, SUM(invoice_details.quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total', 'desc')
            ->take(9)
            ->get();
        // $products = [];
        // foreach ($top_sales as $s){
        //     $p = Product::findOrFail($s->id);
          //  $p->totalQty = $s->total;
        //     $products[] = $p;
        // }

        $p = [];
        foreach ($top_sales as $s) {
            $p[] = $s->id;
            //  $p->totalQty = $s->total;
        }
        $products = Product::with(['stock', 'ratings'])->whereIn('id', $p)->get();
        // dd($products);
        // return $topProducts; //compact
        // best sell product end

        // Vehicle::where('created_at', '<', Carbon::now()->subDays(15))->delete();
        ResentlyViewProduct::where('created_at', '<', Carbon::now()->subMinutes(300))->delete();
        $resently_view_products = ResentlyViewProduct::where('session_id', Session::get('session_id'))->latest()->limit(6)->get();

        if (Cookie::get('suggest_product')) {
            // $latest_products = Product::limit(8)->latest()->get();
            $suggest_products = Product::where('category_id', Cookie::get('suggest_product'))->limit(9)->get();
        } else {
            $suggest_products = collect();
        }

        // banner code
        $banners = ProductPromotion::where([
            'type' => 'banner',
            'status' => true,
        ])->get();
        // promotion code
        $promotions = ProductPromotion::where([
            'type' => 'promotion',
            'status' => true,
        ])->get();

        return view('frontend.index', compact('random', 'new_products', 'topcats', 'categories', 'brands', 'policeis', 'products', 'latest_products', 'resently_view_products', 'suggest_products', 'banners', 'promotions'));
    }

    public function shop(Request $request)
    {
        $search = $request['search'] ?? '';
        if ($search != '') {
            $products = Product::with(['stock', 'ratings'])->where('name', 'LIKE', "%$search%")->paginate(16);
        } else {
            $products = Product::with(['stock', 'ratings'])->paginate(16);
        }

        // $inventories = Inventory::all();
        return view('frontend.shop', compact('products', 'search'));
    }

    public function search_category($id)
    {
        $products = Product::where('category_id', $id)->paginate(6);
        // $inventories = Inventory::all();
        return view('frontend.search_category', compact('products'));
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function getcitylist(Request $request)
    {
        $countries = Country::getByCode($request->billing_country);
        $cities = $countries->children();
        foreach ($cities as $city) {
            echo "<option value='$city->id'>$city->name</option>";
        }
    }

    public function checkout()
    {
        $last_url = explode('/', url()->previous());
        if (end($last_url) == 'cart') {
            $countries = World::Countries();

            return view('frontend.checkout', compact('countries'));
        } else {
            abort(404);
        }
    }

    public function checkoutpost(Request $request)
    {
        //  return Cart::where('user_id', auth()->id())->first()->vendor_id;
        if (session('coupon')) {
            $coupon = session('coupon')->coupon_code;
        } else {
            $coupon = null;
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
            'created_at' => Carbon::now(),
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
                'created_at' => Carbon::now(),
            ]);

            Inventory::where([
                'product_id' => $cart->product_id,
                'size_id' => $cart->size_id,
                'color_id' => $cart->color_id,
            ])->decrement('quantity', $cart->quantity);

            $cart->delete();
        }

        if ($request->payment_method == 'COD') {
            return redirect('cart')->with('success', 'Yor Order Successfully Done!');
        } elseif ($request->payment_method == 'SSL') {
            return redirect('pay')->with('price', session('total_price'));
        } elseif ($request->payment_method == 'stripe') {
            return redirect('stripe')->with('price', session('total_price'));
        } else {
            abort(404);
        }
    }

    public function about()
    {
        $teams = Team::all();

        return view('frontend.about', compact('teams'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function login_register()
    {
        return view('frontend.login_register');
    }

    public function team(Request $request)
    {
        // user device info start
        // $userAgent = $request->header('User-Agent');
        // return $userAgent;
        // user device info end

        // ip location start
        // $ip = $request->getClientIp();
        // $location = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        // return $location;
        // ip location end

        $teams = Team::paginate(5);
        $teams_count = Team::count();
        $deleted_team = Team::onlyTrashed()->get();

        return view('index', compact('teams', 'teams_count', 'deleted_team'));
    }

        public function teampost(Request $request)
        {
            $request->validate([
                '*' => 'required',
            ]);

            $final_name = str_replace(' ', '_', $request->name);
            $new_name = $final_name.'_'.Carbon::now()->format('Y').'_'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->resize(540, 540);
            $img->save(base_path('public/dashboard/uplaods/team_photos/'.$new_name), 90);
            Team::insert([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'designation' => $request->designation,
                'image' => $new_name,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('success', 'Team member Added Successfully!');
        }

        public function contact_post(Request $request)
        {
            $request->validate([
                '*' => 'required',
                'email' => 'email',
            ]);
            Mail::to('tanvir@live.com')->send(new ContactMessage($request->except('_token')));
            //name email subject message
            return back()->with('success', 'Your message send Successfully!');
        }

       public function teamedit($id)
       {
           $data = Team::find($id);

           return view('teamedit', compact('data'));
       }

       public function teamupdate(Request $request, $id)
       {
           // return $request;
           $team = Team::find($id);
           $team->update([
               'name' => $request->name,
               'phone' => $request->phone,
               'email' => $request->email,
               'designation' => $request->designation,
           ]);

           if ($request->hasFile('image')) {
               unlink(base_path('public/dashboard/uplaods/team_photos/'.$team->image));
               $final_name = str_replace(' ', '_', $request->name);
               $new_name = $final_name.'_'.Carbon::now()->format('Y').'_'.time().'.'.$request->file('image')->getClientOriginalExtension();
               $img = Image::make($request->file('image'))->resize(540, 540);
               $img->save(base_path('public/dashboard/uplaods/team_photos/'.$new_name), 90);
               $team->update([
                   'image' => $new_name,
               ]);
           }

           return redirect('team')->with('delete_massege', 'Team member Updateed Successfully!');
       }

       public function teamdelete($id)
       {
           //return $id;
           if ($id == 'all') {
               Team::where('deleted_at', null)->delete();

               return back()->with('delete_massege', 'All Team member Deleted Successfully!');
           } else {
               Team::find($id)->delete();

               return back()->with('delete_massege', 'Team member Deleted Successfully!');
           }
       }

       public function teamrestore($id)
       {
           if ($id == 'all') {
               Team::onlyTrashed()->restore();

               return back();
           } else {
               Team::onlyTrashed()->where('id', $id)->restore();

               return back();
           }
       }

    public function teamforcedelete($id)
    {
        Team::onlyTrashed()->where('id', $id)->forceDelete();

        return back();
    }

    public function single_product($id)
    {
        $product = Product::with('ratings')->find($id);
        $related_product = Product::with(['stock', 'ratings'])->where('category_id', $product->category_id)->where('id', '!=', $id)->limit(6)->get();
        // $inventories = Inventory::all();
        $ratings = $product->ratings;
        $rating_sum = $product->ratings->sum('rating');
        if ($ratings->count() > 0) {
            $avg_rating = $rating_sum / $ratings->count();
        } else {
            $avg_rating = 0;
        }

        // Product view count start
        ProductViewCount::insert([
            'product_id' => $id,
            'created_at' => Carbon::now(),
        ]);
        // Product view count end

        Cookie::queue('suggest_product', $product->category_id, 4300);

        // resently_view_products code start
        if (empty(Session::get('session_id'))) {
            $session_id = rand(00000000, 99999999);
        } else {
            $session_id = Session::get('session_id');
        }
        Session::put('session_id', $session_id);
        $r_v_p_count = DB::table('resently_view_products')->where([
            'product_id' => $id,
            'session_id' => $session_id,
        ])->count();

        if ($r_v_p_count == 0) {
            DB::table('resently_view_products')->insert([
                'product_id' => $id,
                'session_id' => $session_id,
                'created_at' => Carbon::now(),
            ]);
        }
        // resently_view_products code end

        return view('frontend.single_product', compact('product', 'related_product', 'ratings', 'avg_rating'));
    }
}
