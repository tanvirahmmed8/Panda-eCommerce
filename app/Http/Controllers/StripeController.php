<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        if (session('total_price')) {
            $price = session('total_price');

            // return $request;
            Stripe::setApiKey(env('STRIPE_SECRET'));

            Charge::create([
                'amount' => $price * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Test payment from itsolutionstuff.com.Invoice_id='.session('invoice_id'),
                // "customer" => auth()->id()
            ]);

            Invoice::find(session('invoice_id'))->update([
                'payment_status' => 'paid',
            ]);

            return redirect('cart')->with('success', 'Payment successful!');
        } else {
            return redirect('cart')->with('success', 'Opps!');
        }
    }
}
