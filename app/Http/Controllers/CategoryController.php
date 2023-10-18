<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
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
        $categories = Category::all();
        $deleted_categories = Category::onlyTrashed()->get();

        return view('dashboard.category.index', compact('categories', 'deleted_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation start
        $request->validate([
            'category_name' => 'required|unique:categories',
            'category_slug' => 'unique:categories',
            'category_photo' => 'required|image',

        ]);

        // slug empty or not
        if ($request->category_slug) {
            $slug = Str::slug($request->category_slug);
        } else {
            $slug = Str::slug($request->category_name);
        }

        //  image part start
        $new_name = $slug.'_'.auth()->id().'_'.Carbon::now()->format('Y').'_'.time().'.'.$request->file('category_photo')->getClientOriginalExtension();
        $img = Image::make($request->file('category_photo'))->resize(200, 256);
        $img->save(base_path('public/dashboard/uplaods/category_photo/'.$new_name), 90);
        //  image part end

        //  insert data in databese
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'category_photo' => $new_name,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Category Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required',
            'category_photo' => 'image',
        ]);
        Category::find($category->id)->update([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
        ]);

        if ($request->hasFile('category_photo')) {
            // image delete start

            // image delete end
            unlink(base_path('public/dashboard/uplaods/category_photo/'.$category->category_photo));
            //  image part start
            $new_name = $request->category_slug.'_'.auth()->id().'_'.Carbon::now()->format('Y').'_'.time().'.'.$request->file('category_photo')->getClientOriginalExtension();
            $img = Image::make($request->file('category_photo'))->resize(200, 256);
            $img->save(base_path('public/dashboard/uplaods/category_photo/'.$new_name), 90);
            //  image part end
            Category::find($category->id)->update([
                'category_photo' => $new_name,
            ]);
        } else {
            echo 'nai';
            // code...
        }

        return back()->with('success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back();
    }

    public function categoryrestore($id)
    {
        Category::onlyTrashed()->where('id', $id)->restore();

        return back();
    }

    public function forcedelete($id)
    {
        // $photo = Category::onlyTrashed()->select('category_photo')->where('id', $id)->get();
        // $photo = Category::onlyTrashed()->where('id', $id)->get();
        //  return $photo['0']->category_photo;
        $photo = Category::onlyTrashed()->find($id);
        //  return $photo->category_photo;
        unlink(base_path('public/dashboard/uplaods/category_photo/'.$photo->category_photo));
        Category::onlyTrashed()->where('id', $id)->forceDelete();

        return back();
    }
}
