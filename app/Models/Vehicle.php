<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $table = 'vehicles';

    protected $fillable = [
        'user_id',
        'type',
        'status',
        'license',
        'ghana_card',
        'brand',
        'model',
        'year',
        'plate',
    ];
}
