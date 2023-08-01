<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['order_code', 'phone', 'food_taste', 'device', 'prices', 'qr_code', 'primary_id', 'environment', 'service', 'staff_behaviour', 'average', 'comment', 'created_at', 'updated_at'];

    public function feedbacklogs()
    {
        return $this->hasMany(\App\Models\FeedbackLog::class, 'feedback_id', 'id');
    }
}
