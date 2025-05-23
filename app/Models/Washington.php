<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Washington extends Model
{
    use HasFactory;
    use Notifiable;

    public $table = 'washington_listing';


    /**
     * Get all of the all_listing for the Broker
     *
     * @return HasMany
     */
    public function dispatch_listing(): HasMany
    {
        return $this->hasMany(SheetDetails::class, 'orderId');
    }
    
}
