<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookedRoom extends Model
{
    protected $fillable = [
        'name',
        'arrival_date',
        'departure_date',
        'adult',
        'children',
        'email',
        'number',
        'status',
        'stayed',
    ];


    


}