<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\User;
use App\Models\LessonType;


class Subscriptions extends Model
{
    use HasFactory;

    public function lessonType()
    {
        return $this->hasMany(LessonType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
