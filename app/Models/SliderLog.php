<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderLog extends Model
{
    use HasFactory;
    protected $fillable = ['slider_id', 'type', 'primary_id'];

    public function slider()
    {
        return $this->belongsTo(\App\Models\Slider::class, 'slider_id');
    }
}
