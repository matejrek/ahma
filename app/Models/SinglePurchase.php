<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinglePurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lesson_id', 'session_id',
    ];
}
