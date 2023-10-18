<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Khsing\World\Models\City;
use Khsing\World\Models\Country;

class CustomerController extends Controller
{
    public function customer_login_modal(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->with('success', 'You are successfully login');
        } else {
            return back()->with('loginerr', 'Oops Invalid Email or Password!');
        }
    }

    public function customer_login(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('home');
        } else {
            return back()->with('loginerr', 'Oops Invalid Email or Password!');
        }
    }

    public function customer_register(Request $request)
    {
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
        } else {
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
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice', 'invoice_details', 'country', 'city'));

        return $pdf->download(time().'-invoice.pdf');
    }
}
