<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id',
        'subtotal',
        'total_discount',
        'grand_total',
        'payment_method',
        'billing_contact_name',
        'billing_contact_email',
        'billing_contact_number',
        'shipping_contact_name',
        'shipping_contact_email',
        'shipping_contact_number',
        'order_note',
        'restaurant_id',
        "payment_status",
        "addons_total",
        'delivery_day',
        'delivery_time',
        'type',
        'status',
        'tbl_reservation_id'
    ];

    public function address()
    {
        return $this->morphMany(Address::class,'addresable');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }

    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
