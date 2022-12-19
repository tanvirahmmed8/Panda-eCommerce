<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['rating','comment'];


        public function user()
        {
            return $this->hasOne(User::class, 'id', 'user_id');
        }
}
