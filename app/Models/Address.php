<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'landmark',
        'pincode',
        'country',
        'state',
        'city',
    ];

    public function addresable()
    {
        return  $this->morphTo();
    }
    public function states()
    {
        return $this->belongsTo(State::class,'state');
    }
    public function cities()
    {
        return $this->belongsTo(City::class,'city');
    }
    public function countries()
    {
        return $this->belongsTo(Country::class,'country');
    }
}
