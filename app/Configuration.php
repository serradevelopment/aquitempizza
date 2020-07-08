<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['billboard_text','is_freight_unique','is_online','freight_value'];
}
