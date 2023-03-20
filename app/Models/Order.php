<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('first_name', 'last_name','governorate_id', 'company_name', 'country_region', 'address', 'city', 'country_state', 'post_code', 'phone', 'email', 'notes', 'sub_total',  'total', 'client_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

}