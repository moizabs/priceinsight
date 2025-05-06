<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingOptions extends Model
{
    protected $fillable = [
        'disabled_vehicle',
        'in_operable',
        'enclosed_transport',
        'deposit_amount',
        'hide_deposit',
        'user_id',
    ];

    public function authorized_users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
