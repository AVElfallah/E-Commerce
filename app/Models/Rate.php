<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model 
{

    protected $table = 'rates';
    public $timestamps = true;
    protected $fillable = array('rate', 'client_id', 'review' , 'product_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}