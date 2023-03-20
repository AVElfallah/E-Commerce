<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model 
{

    use HasFactory, GetAttribute,HasTranslations;
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('footer_desc', 'fb_link', 'insta_link', 'tw_link', 'you_link', 'wha_link');
    public $translatable = ['footer_desc'];
}