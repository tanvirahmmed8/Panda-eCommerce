<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
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

   public function setting_genarel()
   {
    $settings = Setting::all();
    return view('dashboard.setting.genarel_settinge', compact('settings'));
   }

   public function setting_genarel_save(Request $request)
   {
        foreach($request->except('_token') as $key=>$value){
           Setting::where('setting_key', $key)->update([
                "setting_value" => $value
           ]);
        }

        return back()->with('success', 'Settings Updated Successfully!');
   }

   public function setting_logo()
   {
    $logos = Logo::all();
    return view('dashboard.setting.logo', compact('logos'));
   }

   public function logo_update(Request $request)
   {
// return $request;

    foreach($request->except('_token') as $key=>$value){
        $logo_ex = Logo::where('logo_key', $key)->first()->logo_value;
        if($logo_ex){
            unlink(base_path('public/dashboard/uplaods/logo/'.$logo_ex));
        }
        $new_name = $key.'.'.$request->file($key)->getClientOriginalExtension();
        $img = Image::make($request->file($key));
        $img->save(base_path('public/dashboard/uplaods/logo/'.$new_name), 90);

        Logo::where('logo_key', $key)->update([
            "logo_value" => $new_name
       ]);
    }
    return back()->with('success', 'Logo Updated Successfully!');
    // if ($request->hasFile('brand_logo')) {

    //     unlink(base_path('public/dashboard/uplaods/brand_logo/'.$brand->brand_logo));
    //     //  image part start
    //   $new_name = 'brand'.'_'.auth()->id().'_'.Carbon::now()->format('Y').'_'.time().'.'.$request->file('brand_logo')->getClientOriginalExtension();
    //   $img = Image::make($request->file('brand_logo'))->resize(344, 60);
    //   $img->save(base_path('public/dashboard/uplaods/brand_logo/'.$new_name), 90);
    //   Brand::find($brand->id)->update([
    //     'brand_logo' => $new_name
    //     ]);
    // }
   }
}
