<?php

namespace App\Http\Livewire\Variation;

use Carbon\Carbon;
use App\Models\Color;
use Livewire\Component;

class Addcolor extends Component
{
    public $color_name;
    public $color_code;
    public function render()
    {
        $colors = Color::where('vendor_id', auth()->id())->get();
        return view('livewire.variation.addcolor', compact('colors'));
    }

    public function insert_color(){
        Color::insert([
            'color_name' => $this->color_name,
            'color_code' => $this->color_code,
            'vendor_id' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        $this->reset(['color_name','color_code']);
        session()->flash('success', 'Color successfully added.');
    }

    public function delete_color($id)
    {
        Color::find($id)->delete();
    }
}
