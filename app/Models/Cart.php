<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model 
{
    
    protected $table = 'carts';
    public $timestamps = true;
    protected $fillable = array('product_id','product_color_id' ,'product_size_id','quantity', 'price','sub_total','total' ,'client_id','category_id');



    public function products()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}