<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Khsing\World\Models\City;
use App\Models\Invoice_detail;
use Barryvdh\DomPDF\Facade\Pdf;
use Khsing\World\Models\Country;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customer_login_modal(Request $request){
        $request->validate([
            '*' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
           return back()->with('success', 'You are successfully login');
        }else{
            return back()->with('loginerr', 'Oops Invalid Email or Password!');
        }
    }
    public function customer_login(Request $request){
        $request->validate([
            '*' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect('home');
        }else{
            return back()->with('loginerr', 'Oops Invalid Email or Password!');
        }
    }
    public function customer_register(Request $request){

        $request->validate([
            '*' => 'required',
            'password' => 'confirmed|min:8',
            'email' => 'unique:users|email',

        ]);
        //return $request->password;
        $id = User::insertGetId([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'created_at' => Carbon::now(),
            'role' => 'customer',
        ]);
        User::find($id)->sendEmailVerificationNotification();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('home');
         }else{
             return back()->with('customer_success', 'Oops Invalid Email or Password!');
         }
        //return back()->with('customer_success', 'Your Account Successfully Created! And send a varifacition link on your email!');
    }

    public function download_invoice($id)
    {
        $invoice = Invoice::find($id);
        $city = City::find($invoice->customer_city);
        $country = Country::getByCode($invoice->customer_country);
        $invoice_details = Invoice_detail::with('product')->where('invoice_id', $id)->get();
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice', 'invoice_details','country','city'));
        return $pdf->download(time().'-invoice.pdf');
    }
}
