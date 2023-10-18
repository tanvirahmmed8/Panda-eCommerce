<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
    // protected $with = ['ratings'];

    public function categoryid()
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

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function stock()
    {
        return $this->hasMany(Inventory::class);
    }
}
