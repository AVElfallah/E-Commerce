<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model 
{

    protected $table = 'shipping_cost';
    public $timestamps = true;
    protected $fillable = array('cost');

}