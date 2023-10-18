<?php

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Setting;

function cat()
{
    return $categories = Category::all();
}
function cart_total($product_id, $quantity)
{
    $product = Product::find($product_id);
    if ($product->discounted_price) {
        $total_price = $product->discounted_price;
    } else {
        $total_price = $product->regular_price;
    }

    return $total_price * $quantity;
}
function get_inventory($product_id, $size_id, $color_id)
{
    return Inventory::where([
        'product_id' => $product_id,
        'size_id' => $size_id,
        'color_id' => $color_id,
    ])->first()->quantity;
}

// function rating($id){
//     $ratings = Rating::where('product_id', $id)->get();
//     $rating_sum =  $ratings->sum('rating');
//     if ($ratings->count() > 0) {
//         return $avg_rating = $rating_sum/$ratings->count();
//     } else {
//         return $avg_rating = 0;
//     }
// }
function rating($product)
{
    $rating_sum = $product->ratings->sum('rating');
    if ($product->ratings->count() > 0) {
        return $avg_rating = $rating_sum / $product->ratings->count();
    } else {
        return $avg_rating = 0;
    }
}
function stock($product)
{
    $inventories = $product->stock->sum('quantity');

    return $inventories;
}
function setting($key)
{
    $setting = Setting::where('setting_key', $key)->first()->setting_value;

    return $setting;
}
function logo($key)
{
    $logo = Logo::where('logo_key', $key)->first()->logo_value;

    return $logo;
}

function ordertotal($discount, $subtotal, $delivery_charge)
{
    if ($discount) {
        if ($discount->type == 'flatdiscount') {
            return ($subtotal - $discount->discount_value) + $delivery_charge;
        } else {
            if ($discount->maximum_discount_value) {
                if ($discount->maximum_discount_value < $subtotal * ($discount->discount_value / 100)) {
                    return ($subtotal - $discount->maximum_discount_value) + $delivery_charge;
                } else {
                    return ($subtotal - ($subtotal * ($discount->discount_value / 100))) + $delivery_charge;
                }
            } else {
                return ($subtotal - ($subtotal * ($discount->discount_value / 100))) + $delivery_charge;
            }
        }
    } else {
        return $subtotal + $delivery_charge;
    }
}

function currency()
{
    return '৳';
}

function order()
{
    return Invoice::where('vendor_id', auth()->id())->where('order_status', 'processing')->count();
}
