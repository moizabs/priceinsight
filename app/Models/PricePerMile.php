<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricePerMile extends Model
{
    protected $fillable = [
        'minimum_range',
        'maximum_range',
        'price',
        'user_id',
    ];

    public function authorized_users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

