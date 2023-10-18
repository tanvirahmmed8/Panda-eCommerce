<?php

namespace App\Http\Controllers;

use App\Mail\NewAdminMail;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\ProductPromotion;
use App\Models\Team;
use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

            return view('frontend.customer.dashboard', compact('invoices', 'profile', 'invoices_list'));
        } elseif (auth()->user()->role == 'admin') {
            $teams = Team::all();
            // $date = Carbon::today()->subDays(30);
            $invoices = Invoice::where([
                'payment_status' => 'paid',
                'order_status' => 'deleverd',
            ])->get();
            // $total_earn = 0;
            // foreach($invoices as $invoice){
            //     foreach($invoice->invoice_detail_rel as $d){
            //     $total_earn += $d->product->purchase_price;
            //     }
            // }
            //return $total_earn;
            return view('dashboard.admin.home', compact('teams', 'invoices'));
        } else {
            // $teams = Team::all();
            $date = Carbon::today()->subDays(30);
            $invoices = Invoice::where('vendor_id', auth()->id())->where('created_at', '>=', $date)->get();
            $total_earn = 0;
            foreach ($invoices as $invoice) {
                foreach ($invoice->invoice_detail_rel as $d) {
                    $total_earn += $d->product->purchase_price;
                }
            }
            //return $total_earn;
            return view('home', compact('invoices', 'total_earn'));
        }

        // echo auth()->user()->role;
    }

    public function profileupdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
        ]);
        User::find(auth()->id())->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
        ]);

        if ($request->current_password) {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:8|different:current_password',
                'password_confirmation' => 'required',
            ]);

            if (Hash::check($request->current_password, auth()->user()->password)) {
                User::find(auth()->id())->update([
                    'password' => bcrypt($request->password),
                ]);

                return back()->with('success', 'Your Password successfully changed!');
            } else {
                //echo "password does not match";
                return back()->withErrors('Your current password is incorrect!');
            }
        }

        return back()->with('success', 'Your name & phone number successfully changed!');
    }

    public function users()
    {
        $users = User::latest()->get();

        return view('user', compact('users'));
    }

    public function addnew_admin(Request $request)
    {
        $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:App\Models\User,email',
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

        return back()->with('success', 'New admin added succesfully!');
    }

    public function vendor_action_change($id)
    {
        $user = User::find($id);
        if ($user->action == true) {
            $user->action = false;
        } else {
            $user->action = true;
        }
        $user->save();

        return back();
    }

    public function withdrawal_admin()
    {
        $withdrawal_requests = Withdraw::with(['user_info', 'invoice_info'])->where('status', 'unpaid')->get();
        $withdrawal_paids = Withdraw::with(['user_info', 'invoice_info'])->where('status', 'paid')->get();

        return view('dashboard.admin.withdrawal', compact('withdrawal_requests', 'withdrawal_paids'));
    }

    public function withdrawal_status_change(Request $request)
    {
        foreach ($request->withdrawal as $id) {
            Withdraw::find($id)->update([
                'status' => 'paid',
            ]);

            $invoice = Withdraw::find($id);

            Invoice::find($invoice->invoice_id)->update([
                'withdrawal_status' => 'Withdrawal Done',
            ]);
        }

        return back();
    }

    public function promotion_request()
    {
        $promotions = ProductPromotion::all();

        return view('dashboard.admin.promotion', compact('promotions'));
    }

    public function promotion_status_change($id)
    {
        $promotions = ProductPromotion::find($id);
        if ($promotions->status) {
            $promotions->update([
                'status' => false,
            ]);
        } else {
            $promotions->update([
                'status' => true,
            ]);
        }

        return back();
    }

    public function promotion_delete($id)
    {
        $promotions = ProductPromotion::find($id);
        $promotions->delete();

        return back();
    }
}
