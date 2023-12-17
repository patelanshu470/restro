<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'special_id', 'restaurent_id','name','desc','cost_price','sell_price','product_category','subcategory_id','discount','quantity','weight_per_piece','type','cooking_time','size','addon_id','discount_type','status'
    ];

    public function image()
    {
      return $this->morphMany(Attachment::class,'attachable');
    }
    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class,'restaurent_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'product_category');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

    public function getProductInformation()
    {
        return $this->hasMany(Product::class);
    }

}
