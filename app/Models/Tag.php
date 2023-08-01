<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'title_ar', 'tab_icon', 'web_icon', 'default', 'active', 'created_at', 'updated_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
