<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['payment_status','order_status'];

    /**
     * Get all of the comments for the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoice_detail_rel()
    {
        return $this->hasMany(Invoice_detail::class, 'invoice_id', 'id');
    }
}
