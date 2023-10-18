<?php

namespace App\Http\Livewire\Productdetailse;

use App\Models\Cart;
use Livewire\Component;

class SidebarCart extends Component
{
    protected $listeners = ['updateSidebarCart' => 'render'];

    public function render()
    {
        $cartgs = Cart::where('user_id', auth()->id())->get();

        return view('livewire.productdetailse.sidebar-cart', compact('cartgs'));
    }
}
