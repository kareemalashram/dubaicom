<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $guarded = [];
    public $casts = [
        'phone' => 'array'
    ];
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
