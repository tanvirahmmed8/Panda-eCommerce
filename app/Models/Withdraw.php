<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    /**
     * Get the user associated with the Withdraw
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_info()
    {
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
    public function invoice_info()
    {
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }
}
