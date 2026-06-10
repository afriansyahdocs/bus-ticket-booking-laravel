<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'schedule_id', 'order_code',
        'total_passengers', 'total_price', 'status', 'booked_at',
    ];

    protected $casts = [
        'booked_at' => 'datetime',
    ];
}
