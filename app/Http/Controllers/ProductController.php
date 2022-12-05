<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.product.index',[
            'products' => Product::with('categoryid')->where('vendor_id', auth()->id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get(['id','category_name']);
        return view('dashboard.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'purchase_price' => 'required|numeric',
            'regular_price' => 'required|numeric',
            'discounted_price' => 'numeric|nullable',
            'description' => 'required',
            'short_description' => 'required',
            'additional_information' => 'required',
        ]);
        // return $request->except('_token')+[
        //     'vendor_id' => auth()->id(),
        //     'thumbnail' => 'pic.png'
        // ];
        $product = Product::create($request->except('_token')+[
            'vendor_id' => auth()->id()
        ]);
        if ($request->hasFile('thumbnail')) {
            $new_name = $product->id.'_'.auth()->id().'_'.time().'.'.$request->file('thumbnail')->getClientOriginalextension();
            $img = Image::make($request->file('thumbnail'))->resize(800, 609);
            $img->save(base_path('public/dashboard/uplaods/product_thumbnail/'.$new_name), 90);

            Product::find($product->id)->update([
                'thumbnail' => $new_name
            ]);
        }

        return back()->with('success', 'Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function inventory(Product $product)
    {
        $colors = Color::where('vendor_id', auth()->id())->get();
        $sizes = Size::where('vendor_id', auth()->id())->get();
        $inventories = Inventory::where([
            'vendor_id' => auth()->id(),
            'product_id' => $product->id,
        ])->get();
        return view('dashboard.product.addinventory', compact('product','colors','sizes','inventories'));
    }
    public function addinventory(Product $product, Request $request)
    {
        $inventory =  Inventory::where([
            'product_id' => $product->id,
            'vendor_id' => auth()->id(),
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
        ])->first();

        if ($inventory) {
            $inventory->increment('quantity', $request->quantity);
            $inventory->save();
        } else {
            Inventory::insert([
                'product_id' => $product->id,
                'vendor_id' => auth()->id(),
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now()
            ]);
        }
        return back();
    }
}

