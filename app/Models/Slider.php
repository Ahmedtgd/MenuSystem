<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image', 'description', 'web_image', 'primary_id'];

    public function sliderlogs()
    {
        return $this->hasMany(\App\Models\SliderLog::class, 'slider_id', 'id');
    }
}
