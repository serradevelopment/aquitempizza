<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_name','client_address','is_card','troco','freight_id','total'];
    protected $with     = ['products','freight'];

    public function products(){
        return $this->belongsToMany('App\Product');
    }

    public function freight(){
        return $this->belongsTo('App\Freight');
    }
}
