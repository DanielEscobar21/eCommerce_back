<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'cart_id',
        'user_id',
        'quantity',
        'total_price' ,
        'status'
    ];
}
