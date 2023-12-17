<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city()
    {
        return $this->hasMany(City::class,'city_id');
    }
    public function states()
    {
        return $this->hasMany(Restaurant::class,'state_id');
    }
    public function countris()
    {
        return $this->hasMany(Restaurant::class,'state_id');
    }
}
