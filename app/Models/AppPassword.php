<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppPassword extends Model
{
    use HasFactory;

    protected $fillable = ['password', 'old_password'];
}
