<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function sizeid()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }

    public function colorid()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
}
