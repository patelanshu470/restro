<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'res_date',
        'guest_number',
        'restaurant_id',
        'table_id',
        'status',
        'from_time',
        'to_time',
        'user_id'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class)->withTrashed();
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id')->withTrashed();
    }

}
