<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
     protected $fillable = ['title', 'parentId', 'image', 'thumbnail', 'order', 'title_ar', 'tab_image', 'primary_id'];

    public function subcategory()
    {
        return $this->hasMany(\App\Models\Category::class, 'parentId');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parentId');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'categoryId', 'translationId');
    }

    public function catlogs()
    {
        return $this->hasMany(\App\Models\CategoryLog::class, 'category_id', 'id');
    }
}
