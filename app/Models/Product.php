<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    function categoryid()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_image()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
