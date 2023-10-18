<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];

    public function productrel()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function size_rel()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }

    public function color_rel()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }

    public function vendor_rel()
    {
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
}
