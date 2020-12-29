<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\User;
use App\Models\LessonAccessLevel;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_type', 'title', 'description', 'content', 
    ];

    public function accessLevel(){
        return $this->hasOne(LessonAccessLevel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
