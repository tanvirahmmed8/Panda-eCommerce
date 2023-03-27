<?php

namespace App\Http\Livewire\Productdetailse;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;

class Addtocart extends Component
{
    public $product_id;
    public $size_dropdown;
    public $color_dropdown;
    public $available_colors;
    public $inventory;
    public $stock = 0;
    public $unit_price = 0;
    public $total_price = 0;
    public $count = 1;
    public $count_show = "d-none";
    public $test;

    public function increment()
    {
        if ($this->count < $this->stock) {
        $this->count++;
        $this->total_price= $this->unit_price*$this->count;
        }
    }
    public function decrement()
    {
        if ($this->count > 1) {
            $this->count--;
            $this->total_price= $this->unit_price*$this->count;
        }
    }
    public function updatedSizeDropdown($size_id){
        $this->available_colors = Inventory::where([
            'product_id' => $this->product_id,
            'size_id' => $size_id,
            ])->get();
        $this->stock = 0;
        $this->unit_price =0;
        $this->count_show = "d-none";
        $this->count = 1;
        $this->total_price = $this->unit_price;
    }
    public function updatedColorDropdown($inventory_id){
        $this->inventory = Inventory::find($inventory_id);
        if($this->inventory){
            $this->stock = $this->inventory->quantity;
            $product = Product::find($this->inventory->product_id);
            if ($product->discounted_price) {
                $this->unit_price = $product->discounted_price;
            }else{
                $this->unit_price = $product->regular_price;
            }
            $this->count_show = "";
        }else{
            $product = "";
            $this->stock = 0;
            $this->count_show = "d-none";
            $this->unit_price = 0;
        }


        $this->total_price = $this->unit_price;

    }

    public function render()
    {
        $available_sizes = Inventory::with('sizeid')->select('size_id')->where('product_id', $this->product_id)->groupBy('size_id')->get();
        return view('livewire.productdetailse.addtocart', compact('available_sizes'));
    }
    public function addtocartbtn()
    {

        if (
            Cart::where([
                'user_id' => auth()->id()
            ])->exists()
        ) {
            if (
                Cart::where([
                    'user_id' => auth()->id()
                ])->first()->vendor_id == $this->inventory->vendor_id
            ) {
                if (
                    Cart::where([
                        'user_id' => auth()->id(),
                        'vendor_id' => $this->inventory->vendor_id,
                        'product_id' => $this->inventory->product_id,
                        'size_id' => $this->inventory->size_id,
                        'color_id' => $this->inventory->color_id
                    ])->exists()
                ) {
                    Cart::where([
                        'user_id' => auth()->id(),
                        'vendor_id' => $this->inventory->vendor_id,
                        'product_id' => $this->inventory->product_id,
                        'size_id' => $this->inventory->size_id,
                        'color_id' => $this->inventory->color_id
                    ])->increment('quantity', $this->count);
                    session()->flash('cart_success', 'Product successfully added on your cart!');
                } else {
                    Cart::insert([
                        'user_id' => auth()->id(),
                        'vendor_id' => $this->inventory->vendor_id,
                        'product_id' => $this->inventory->product_id,
                        'size_id' => $this->inventory->size_id,
                        'color_id' => $this->inventory->color_id,
                        'quantity' => $this->count,
                        'created_at' => Carbon::now()
                    ]);
                    session()->flash('cart_success', 'Product successfully added on your cart!');
                }
            } else {
                session()->flash('cart_error', "you can't buy others vendor's product at a time!");
            }

        }else{
            Cart::insert([
                'user_id' => auth()->id(),
                'vendor_id' => $this->inventory->vendor_id,
                'product_id' => $this->inventory->product_id,
                'size_id' => $this->inventory->size_id,
                'color_id' => $this->inventory->color_id,
                'quantity' => $this->count,
                'created_at' => Carbon::now()
            ]);
            session()->flash('cart_success', 'Product successfully added on your cart!');
        }
/////////////////////////////

        $this->count_show = "d-none";
        $this->emit('updateCartCounter');
        $this->emit('updateSidebarCart');

    }

}
