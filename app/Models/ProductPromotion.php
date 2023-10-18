<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPromotion extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function user_info()
    {
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
}
