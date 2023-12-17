<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addons extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name', 'restaurant_id','price','cost_price',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }
}
