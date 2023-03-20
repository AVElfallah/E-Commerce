<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    use HasFactory;
    protected $table = 'coupon_users';
    protected $guarded = [];
    
    public function coupon()
    {
        return $this->hasMany(Coupon::class , 'id' , 'coupon_id');
    }
}
