<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    
    protected $table = 'coupons';
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'expire_date'];
    
    public function CouponUser()
    {
        return $this->hasMany(CouponUser::class);
    }
}
