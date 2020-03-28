<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','value','description','image_extension','category','locked'];


    public static function categories()
    {
    	return ['PIZZAS','BEBIDAS'];
    } 
}
