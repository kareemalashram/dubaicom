<?php

namespace App;
use \Dimsav\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use \Astrotomic\Translatable\Translatable;
    public $guarded = [];
    public $translatedAttributes = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
