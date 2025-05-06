<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZipCodeExceptions extends Model
{
    protected $fillable = [
        'route_type',
        'operation_type',
        'origin_zipcode',
        'destination_zipcode',
        'value',
        'value_percentage',
        'user_id',
    ];

    public function authorized_users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
