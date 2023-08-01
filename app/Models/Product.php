<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'chilli', 'halal', 'popular', 'vageterian', 'title_ar', 'order', 'categoryId', 'price', 'primary_id', 'nutritionInfo', 'ingredients', 'nutritionInfo_ar', 'ingredients_ar', 'image', 'isFeatured', 'thumbnail'];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'categoryId');
    }
    public function images()
    {
        return $this->hasMany(\App\Models\Image::class, 'product_id', 'translationId');
    }
    public function productlogs()
    {
        return $this->hasMany(\App\Models\ProductLog::class, 'product_id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
