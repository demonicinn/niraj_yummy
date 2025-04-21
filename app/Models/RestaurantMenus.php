<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantMenus extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'restaurant_id',
        'appetizers',
        'entree',
        'desserts',
        'drinks',
    ];

    //...
    public function getAppetizersAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }

    public function getEntreeAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }

    public function getDessertsAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }

    public function getDrinksAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }



}
