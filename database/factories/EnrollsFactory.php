<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\LessonType;
use App\Models\Enrolls;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class EnrollsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enrolls::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function(){
                return User::all()->random();
            },
            'lesson_type_id' => function(){
                return LessonType::all()->random();
            },
        ];
    }
}
