<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Restaurants extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'type',
        'capacity',
        'latitue',
        'longitude',
        'booking_mode',
        'last_updated',
        'open_now',
        'website_link',
        'distance',
        'rating',
        'user_ratings_total',
        'place_id',
        'image_url',
        'formatted_address',
        'formatted_phone_number',
        //...
        'editorial_summary',
        'geometry',
        'opening_hours',
        'photos',
        'reviews',
    ];


    //...
    public function getEditorialSummaryAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }

    public function getGeometryAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }

    public function getOpeningHoursAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }

    public function getPhotosAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }

    public function getReviewsAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }


    //...
    public function userRestaurants(){
        return $this->hasMany(UserRestaurants::class, 'restaurant_id');
    }

    public function restaurantMenus(){
        return $this->hasOne(RestaurantMenus::class, 'restaurant_id');
    }

    public function restaurantReviews(){
        return $this->hasMany(RestaurantReviews::class, 'restaurant_id');
    }

    

}
