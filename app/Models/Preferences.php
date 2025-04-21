<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preferences extends Model
{
    //
    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'data',
    ];

    //...
    public function getDataAttribute($value){
        if($value)
            return json_decode($value);

        return '';
    }
}
