<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackLog extends Model
{
    use HasFactory;
    protected $fillable = ['feedback_id', 'type', 'primary_id'];

    public function feedback()
    {
        return $this->belongsTo(\App\Models\Feedbacks::class, 'feedback_id');
    }
}
