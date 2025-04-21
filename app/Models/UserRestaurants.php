<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRestaurants extends Model
{
    //...
    protected $fillable = [
        'user_id',
        'restaurant_id',
    ];
}
