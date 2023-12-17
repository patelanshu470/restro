<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    use HasFactory;

   protected $fillable = [
        'facebook_url',
        'instagram_url',
        'restro_image',
        'restaurant_name',
        'restro_contact_number',
        'm_first_name',
        'm_last_name',
        'm_contact_number',
    ];

    public function address()
    {
        return $this->morphMany(Address::class,'addresable');
    }
    public function states()
    {
        return $this->belongsTo(State::class,'state_id');
    }
    public function contries()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function image()
    {
      return $this->morphMany(Attachment::class,'attachable');
    }
    public function addons()
    {
        return $this->belongsTo(Addons::class,'restaurant_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'restaurants_id');
    }

    public function getaddress()
    {
        return $this->morphOne(Address::class,'addresable');
    }

    public function cities()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
