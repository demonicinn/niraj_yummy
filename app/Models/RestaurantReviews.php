<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantReviews extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'review',
        'rating',
        'image',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(){
        if($this->image)
            return asset('storage/reviews/'.$this->image);

        return '';
    }

    //...
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
