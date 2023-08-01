<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'product_id', 'cover'];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'translationId');
    }
}
