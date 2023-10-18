<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Shipping;
use Livewire\Component;

class Show extends Component
{
    public $quantity;

    public $coupon_error;

    public $coupon_code;

    public $coupon_for_session;

    public $discount;

    public $delivery_charge = 0;

    public $delivery_forbutton = 0;

    // public $test;
    public function render()
    {
        $shippings = Shipping::where('status', true)->get();
        $carts = Cart::where('user_id', auth()->id())->get();

        return view('livewire.cart.show', compact('carts', 'shippings'));
    }

    public function cart_delete($cart_id)
    {
        Cart::findOrFail($cart_id)->delete();
        $this->emit('updateCartCounter');
        $this->emit('updateSidebarCart');
    }

    public function decrement($cart_id)
    {
        $dec = Cart::find($cart_id);
        if ($dec->quantity > 1) {
            $dec->decrement('quantity');
        }
    }

    public function increment($cart_id)
    {
        Cart::find($cart_id)->increment('quantity');
    }

    public function inputValue($cart_id, $quantity)
    {
        $this->quantity = $quantity;
        if ($quantity) {
            if ($quantity >= 1) {
                Cart::find($cart_id)->update([
                    'quantity' => $quantity,
                ]);
            }
        }
    }

    public function applycoupon($vendor_id, $subtotal)
    {
        if ($this->coupon_code) {
            if (Coupon::where('coupon_code', $this->coupon_code)->exists()) {
                $coupon = Coupon::where('coupon_code', $this->coupon_code)->first();
                if ($coupon->vendor_id == $vendor_id) {
                    if ($coupon->minimum_purchase_amount < $subtotal) {
                        if ($coupon->type == 'percentage') {
                            $this->discount = $coupon;
                            $this->coupon_error = '';
                            $this->coupon_for_session = $coupon;
                        // session(['coupon' => $coupon]);
                        } else {
                            $this->discount = $coupon;
                            $this->coupon_error = '';
                            $this->coupon_for_session = $coupon;
                            // session(['coupon' => $coupon]);
                        }
                    } else {
                        $this->coupon_error = "Minimum purchase amount $coupon->minimum_purchase_amount !";
                        $this->discount = '';
                        $this->coupon_for_session = '';
                        // session(['coupon' => '']);
                    }
                } else {
                    $this->coupon_error = 'This coupon code for other vendor!';
                    $this->discount = '';
                    $this->coupon_for_session = '';
                    // session(['coupon' => '']);
                }
            } else {
                $this->coupon_error = 'Invalid coupon code!';
                $this->discount = '';
                $this->coupon_for_session = '';
                // session(['coupon' => '']);
            }
        } else {
            $this->coupon_error = 'Coupon feild is empty!';
            $this->discount = '';
            session(['coupon' => '']);
        }
    }

    public function delivery($id)
    {
        $shipping = Shipping::find($id);
        if ($id != 0) {
            // $this->delivery_charge = 100;
            $this->delivery_charge = $shipping->shipping_value;
            $this->delivery_forbutton = 1;
        } else {
            $this->delivery_charge = 0;
            $this->delivery_forbutton = 0;
        }
    }
}
