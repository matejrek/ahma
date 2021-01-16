<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Enrolls;
use App\Models\Subscriptions;

class LessonType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'stripe_sub_id', 'slug', 'about',
    ];

    public function enrolls()
    {
        return $this->hasMany(Enrolls::class);
    }


    public function subscription()
    {
        return $this->belongsTo(Subscriptions::class, 'stripe_sub_id', 'stripe_plan');
    }

}
