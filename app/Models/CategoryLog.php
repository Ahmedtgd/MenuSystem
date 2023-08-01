<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLog extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'type', 'primary_id'];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
}
