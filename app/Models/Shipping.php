<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table = 'shipping_cost';
    protected $guarded = [];


    public function governorate()
    {
        return $this->belongsTo('App\Models\Gov');
    }
}
