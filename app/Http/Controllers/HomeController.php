<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Invoice;
use App\Mail\NewAdminMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'customer') {
            $profile = User::find(auth()->id());
            $invoices = Invoice::where('user_id', auth()->id())->get();
            $invoices_list = Invoice::where('user_id', auth()->id())->paginate(10);
            return view('frontend.customer.dashboard', compact('invoices','profile','invoices_list'));
        }else{
            $teams = Team::all();
            $invoices = Invoice::where('vendor_id', auth()->id())->get();
            return view('home', compact('teams','invoices'));
        }

        // echo auth()->user()->role;
    }

    public function profileupdate(Request $request){

        $request->validate([
            'name' => 'required',
            'phone_number' => 'required'
        ]);
        User::find(auth()->id())->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number
        ]);

         if($request->current_password){
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
         }

            return back()->with('success', 'Your name & phone number successfully changed!');
    }

    public function users(){
        $users = User::latest()->get();
        return view('user', compact('users'));
    }
    public function addnew_admin(Request $request){
        $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:App\Models\User,email'
        ]);
        $password = Str::upper(Str::random(8));
        User::insert([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => bcrypt($password),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);

        Mail::to($request->admin_email)->send(new NewAdminMail(auth()->user()->name, $request->admin_email, $password, $request->admin_name));
        return back()->with('success', "New admin added succesfully!");
    }

    public function vendor_action_change($id){
       $user = User::find($id);
       if ($user->action == true) {
            $user->action = false;
       }else{
            $user->action = true;
       }
       $user->save();
       return back();
    }

}
