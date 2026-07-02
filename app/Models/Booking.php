<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
    'user_id',
    'check_in',
    'check_out',
    'guests',
    'total_price',
    'status',
    'payment_method',
    'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
