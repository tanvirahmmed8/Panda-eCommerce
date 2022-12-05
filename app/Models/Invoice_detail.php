<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_detail extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne(product::class, 'id', 'product_id');
    }
}
