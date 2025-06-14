<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Washington extends Model
{
    use HasFactory;
    use Notifiable;

    public $table = 'washington_listing';

    protected $fillable = [
        'originzsc',
        'destinationzsc',
        'ymk', 
        'type',
        'condition',
        'transport',
        'pstatus',
        'listed_price',
        'user_id',
    ];


    /**
     * Get all of the all_listing for the Broker
     *
     * @return HasMany
     */
    public function dispatch_listing(): HasMany
    {
        return $this->hasMany(SheetDetails::class, 'orderId');
    }

    /**
     * Get the authorized_user that owns the AllListing
     *
     * @return BelongsTo
     */
    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
