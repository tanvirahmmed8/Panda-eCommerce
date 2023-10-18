<?php

namespace App\Http\Livewire\Productdetailse;

use App\Models\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    public $count = 0;

    protected $listeners = ['updateCartCounter' => 'render'];

    public function render()
    {
        $this->count = Cart::where('user_id', auth()->id())->count();

        return view('livewire.productdetailse.cart-counter');
    }
}
