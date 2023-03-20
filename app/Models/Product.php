<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, GetAttribute, HasTranslations;

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array( 'title','description', 'category_id','quantity' ,'price', 'tax', 'price_after_tax');
    public $translatable = ['title', 'description'];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
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

    public function productColors()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Rate::class, 'product_id', 'id');
    }

}
