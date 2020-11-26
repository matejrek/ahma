<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\User;
use App\Models\LessonType;
use App\Models\Subscriptions;

class Enrolls extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lesson_type_id', 
    ];


    public function lessonType()
    {
        return $this->belongsTo(LessonType::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
 
}
