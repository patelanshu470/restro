<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'state_id','country_id'
    ];
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }
    public function cities()
    {
        return $this->hasMany(City::class,'city');
    }
    public function countries()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
