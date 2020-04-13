<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','value','description','image_extension','category','locked','tag','is_top'];


    public static function categories()
    {
    	return ['PIZZAS','BEBIDAS'];
    } 

    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}
