<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonAccessLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lesson_type_id', 'lesson_id', 'premium',
    ];
}
