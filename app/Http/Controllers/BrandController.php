<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('dashboard.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brand.create');
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
            'brand_logo' => 'required|image',
            'brand_link' => 'required|url',
        ]);
          //  image part start
          $new_name = 'brand'.'_'.auth()->id().'_'.Carbon::now()->format('Y').'_'.time().'.'.$request->file('brand_logo')->getClientOriginalExtension();
          $img = Image::make($request->file('brand_logo'))->resize(344, 60);
          $img->save(base_path('public/dashboard/uplaods/brand_logo/'.$new_name), 90);
          //  image part end

          //  insert data in databese
         Brand::insert([
            'brand_logo' => $new_name,
            'brand_link' => $request->brand_link,
            'created_at' => Carbon::now(),
         ]);

         return back()->with('success', 'Brand successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('dashboard.brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
         $request->validate([
            'brand_link' => 'required|url'
        ]);
        Brand::find($brand->id)->update([
            'brand_link' => $request->brand_link
        ]);
        if ($request->hasFile('brand_logo')) {

            unlink(base_path('public/dashboard/uplaods/brand_logo/'.$brand->brand_logo));
            //  image part start
          $new_name = 'brand'.'_'.auth()->id().'_'.Carbon::now()->format('Y').'_'.time().'.'.$request->file('brand_logo')->getClientOriginalExtension();
          $img = Image::make($request->file('brand_logo'))->resize(344, 60);
          $img->save(base_path('public/dashboard/uplaods/brand_logo/'.$new_name), 90);
          Brand::find($brand->id)->update([
            'brand_logo' => $new_name
            ]);
        }
        // return $brand->brand_logo;
        return back()->with('success', 'Brand successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        unlink(base_path('public/dashboard/uplaods/brand_logo/'.$brand->brand_logo));
        $brand->delete();
        return back();
    }

    public function change_status(Request $request,$id){
        $request->validate([
            'status' => 'required'
        ]);

        if ($request->status == 'active') {
            Brand::find($id)->update([
                'status' => 'active'
            ]);
        }else{
            Brand::find($id)->update([
                'status' => 'deactive'
            ]);
        }
        return back();
    }
}
