<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPassenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'passenger_name', 'id_number', 'seat_number',
    ];
}
