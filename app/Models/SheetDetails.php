<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class SheetDetails extends Model
{

    use HasFactory;
    use Notifiable;

    public $table = 'sheet_details';

     /**
     * Get the authorized_user that owns the AllListing
     *
     * @return BelongsTo
     */
    public function washington_listing(): BelongsTo
    {
        return $this->belongsTo(Washington::class, 'orderId', 'id');
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
