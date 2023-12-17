<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'product_id',
        'quantity',
        'price',
        'discount',
        'total_price',
        'total_cost_price',
    ];

    public function getproductsData()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
