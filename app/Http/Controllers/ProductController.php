<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\ProductImage;
use Illuminate\Support\Str;
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
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg'
            // 'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
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
    public function product_image_add(Product $product)
    {
        return view('dashboard.product.add_product_image', compact('product'));
    }

    public function product_image_post(Request $request, Product $product)
    {
        // $product->id;
        // return $request->hasFile('image');
        if ($request->hasFile('image')) {
            $new_name = $product->id.'_'.auth()->id().'_'.time().Str::random(12).'.'.$request->file('image')->getClientOriginalextension();
            $img = Image::make($request->file('image'))->resize(680, 680);
            $img->save(base_path('public/dashboard/uplaods/product_thumbnail/'.$new_name), 100);

            ProductImage::insert([
                'product_id' => $product->id,
                'image' => $new_name,
                'created_at'=> Carbon::now()
            ]);
        }

        return back()->with('success', 'Image Added Successfully!');
    }

    public function product_image_delete($id)
    {
        $product_image = ProductImage::find($id);
        $product_image->delete();

        return back()->with('success', 'Image Delete Successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get(['id','category_name']);
        return view('dashboard.product.edit', compact('categories','product'));
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
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'purchase_price' => 'required|numeric',
            'regular_price' => 'required|numeric',
            'discounted_price' => 'numeric|nullable',
            'description' => 'required',
            'short_description' => 'required',
            'additional_information' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg'
        ]);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'purchase_price' => $request->purchase_price,
            'regular_price' => $request->regular_price,
            'discounted_price' => $request->discounted_price,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'additional_information' => $request->additional_information
        ]);
        if ($request->hasFile('thumbnail')) {
            unlink(base_path('public/dashboard/uplaods/product_thumbnail/'.$product->thumbnail));
            $new_name = $product->id.'_'.auth()->id().'_'.time().'.'.$request->file('thumbnail')->getClientOriginalextension();
            $img = Image::make($request->file('thumbnail'))->resize(800, 609);
            $img->save(base_path('public/dashboard/uplaods/product_thumbnail/'.$new_name), 90);

            $product->update([
                'thumbnail' => $new_name
            ]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
    public function restore($product_id)
    {
         $product = Product::withTrashed()->where('id', $product_id)->restore();
        //  $product->restore();
        return back();
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

