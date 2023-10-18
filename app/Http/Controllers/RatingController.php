<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RatingController extends Controller
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

    public function rating(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        $product_check = Product::where('id', $request->product_id)->get();
        if ($product_check) {
            $verified_purchase = Invoice::where('invoices.user_id', auth()->id())->join('invoice_details', 'invoices.id', 'invoice_details.invoice_id')->where('invoice_details.product_id', $request->product_id)->first();
            if ($verified_purchase) {
                $rating_check = Rating::where('user_id', auth()->id())->where('product_id', $request->product_id)->first();
                if ($rating_check) {
                    Rating::where('user_id', auth()->id())->where('product_id', $request->product_id)->update([
                        'rating' => $request->rating,
                        'comment' => $request->comment,
                    ]);

                    return back();
                } else {
                    Rating::insert([
                        'user_id' => auth()->id(),
                        'product_id' => $request->product_id,
                        'rating' => $request->rating,
                        'comment' => $request->comment,
                        'created_at' => Carbon::now(),
                    ]);

                    return back();
                }
            } else {
                return 'You can`t rate this product with out purchase!';
            }
        } else {
            return 'Link is broken';
        }
    }
}
