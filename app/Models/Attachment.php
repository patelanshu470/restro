<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'path','field_name', 'attachable_type','attachable_id'
    ];

    protected $guards =[];

    public function attachable(){
        return $this->morphTo();
    }
}
