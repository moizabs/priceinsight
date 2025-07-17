<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Freight_Listing extends Model
{
    protected $table = "freight_listings";

    protected $fillable = [
        'origin_location',
        'destination_location',
        'trailer_type',
        'load_type',
        'freight_width',
        'freight_length',
        'posting_rate',
        'carrier_offer',
        'shipper_charge',
        'acceptance_rate',
        'total_average',
        'user_id'
    ];
}
