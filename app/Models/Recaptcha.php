<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recaptcha extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_key','secret_key'
    ];
}
