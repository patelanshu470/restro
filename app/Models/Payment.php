<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'payment_status',
        'amount',
        'order_id',
        'payment_method',

    ];


    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
