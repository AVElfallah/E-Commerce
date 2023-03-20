<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model 
{
    use HasFactory, GetAttribute , HasTranslations;
    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('title','status','description');
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