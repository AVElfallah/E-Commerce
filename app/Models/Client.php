<?php

namespace App\Models;

use App\Models\Cart;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('user_name', 'email','password', 'pin_code','governorate_id');


    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function rates()
    {
        return $this->hasMany('App\Models\Rate');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function governorate()
    {
        return $this->belongsTo('App\Models\Gov');
    }

    

}