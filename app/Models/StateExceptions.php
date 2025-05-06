<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateExceptions extends Model
{
    protected $fillable = [
        'origin_state',
        'destination_state',
        'route_type',
        'operation_type',
        'value',
        'value_percentage',
        'user_id',
    ];

    public function authorized_users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
