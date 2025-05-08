<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleTypeSetting extends Model
{
    protected $fillable = [
        'vehicle_type',
        'operation_type',
        'price',
        'user_id',
    ];

    public function authorized_users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
