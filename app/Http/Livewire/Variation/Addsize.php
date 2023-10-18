<?php

namespace App\Http\Livewire\Variation;

use App\Models\Size;
use Carbon\Carbon;
use Livewire\Component;

class Addsize extends Component
{
    public function render()
    {
        $sizes = Size::where('vendor_id', auth()->id())->get();

        return view('livewire.variation.addsize', compact('sizes'));
    }

    public $size;

    protected $rules = [
        'size' => 'required',
    ];

    public function insert_size()
    {
        $this->validate();
        Size::insert([
            'size' => $this->size,
            'vendor_id' => auth()->id(),
            'created_at' => Carbon::now(),
        ]);
        $this->reset('size');
        session()->flash('success', 'Size successfully added.');
    }

    public function delete_size($id)
    {
        Size::find($id)->delete();
    }
}
