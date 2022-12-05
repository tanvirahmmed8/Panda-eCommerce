<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
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


    public function profile(){
        return view('dashboard.profile.profile');
    }
    public function profilephotoupload(Request $request){
        $request->validate([
            'profile_photo' => 'required|image'
        ]);
        $name = auth()->user()->name;
        $final_name = str_replace(" ","_",$name);
        $new_name = $final_name.'_'.auth()->id().'_'.Carbon::now()->format('Y').'.'.$request->file('profile_photo')->getClientOriginalExtension();
        //return $request->file('profile_photo');
        $img = Image::make($request->file('profile_photo'))->resize(196, 196);
        //$path = base_path('public/');
        $img->save(base_path('public/dashboard/uplaods/profile_photos/'.$new_name), 80);

        User::find(auth()->id())->update([
            'profile_photo' => $new_name
        ]);
        return back();
    }
    public function coverphoto(Request $request){
        $request->validate([
            'cover_photo' => 'required|image'
        ]);
        $name = auth()->user()->name;
        $final_name = str_replace(" ","_",$name);
         $new_name = 'coverphoto'.'_'.$final_name.'_'.auth()->id().'_'.Carbon::now()->format('Y').'.'.$request->file('cover_photo')->getClientOriginalExtension();


         $img = Image::make($request->file('cover_photo'))->resize(1600, 451);

         $img->save(base_path('public/dashboard/uplaods/cover_photos/'.$new_name), 80);

        User::find(auth()->id())->update([
            'cover_photo' => $new_name
        ]);
        return back();
    }

    public function password_change(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8|different:current_password',
            'password_confirmation' => 'required',
        ]);

        if(Hash::check($request->current_password, auth()->user()->password)){
            User::find(auth()->id())->update([
                'password' => bcrypt($request->password),
            ]);
            return back()->with('success', 'Your Password successfully changed!');
        }else{
            //echo "password does not match";
            return back()->withErrors('Your current password is incorrect!');
        }
        //return $request->password;


    }
}
