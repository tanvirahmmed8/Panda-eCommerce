<?php

namespace App\Http\Livewire\Shipping;

use App\Models\Shipping;
use Carbon\Carbon;
use Livewire\Component;

class Add extends Component
{
    public $shipping;
    public $shipping_value;

    protected $rules = [
        'shipping' => 'required',
        'shipping_value' => 'required',
    ];

    public function render()
    {
        $shippings = Shipping::all();
        return view('livewire.shipping.add', compact('shippings'));
    }
    public function add_shipping()
    {
        $this->validate();

        Shipping::insert([
            'shipping' => $this->shipping,
            'shipping_value' => $this->shipping_value,
            'created_at' => Carbon::now()
        ]);
        $this->reset(['shipping','shipping_value']);
        session()->flash('message', 'Shipping successfully added.');
    }

    public function status_change($id)
    {
        $shipping = Shipping::find($id);
       if ($shipping->status == true) {
            $shipping->status = false;
       }else{
            $shipping->status = true;
       }
       $shipping->save();
    }
}
