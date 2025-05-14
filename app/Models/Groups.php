<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    //
    protected $fillable = [
        'user_id',
        'unique_code',
        'name',
        'status',
    ];

    //...
    public function groupUsers(){
        return $this->hasMany(GroupUsers::class, 'group_id');
    }

    //...
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
