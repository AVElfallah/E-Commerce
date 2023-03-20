<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model 
{

    protected $table = 'order_item';
    public $timestamps = true;
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category' , 'category_id','id');
    }

public function product()
    {
        return $this->belongsTo('App\Models\Product' , 'product_id','id');
    }
}