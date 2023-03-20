<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model 
{
    use HasFactory, GetAttribute ,HasTranslations;
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name', 'description');
    public $translatable = ['name', 'description'];


    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multiple_attachment = true;
        $this->multiple_attachment_usage = ['default', 'bdf-file'];
    }
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

}