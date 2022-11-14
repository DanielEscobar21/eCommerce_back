<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id' ,
        'user_id',
        'amount',
        'created_at',
        'updated_at'
    ];
}
