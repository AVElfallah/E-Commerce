<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use App\Traits\GetAttribute;


class Card extends Model 
{
    use HasFactory, GetAttribute,HasTranslations;
    protected $table = 'cards';
    public $timestamps = true;
    protected $fillable = array('title', 'description');
    public $translatable = ['title', 'description'];
   


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