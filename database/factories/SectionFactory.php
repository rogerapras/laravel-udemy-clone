<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Section;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    $max = Section::max('id');
    return [
        //'course_id' => 1,
        'uuid' => (string)\Str::uuid(),
        'title' => \Str::title($faker->unique()->sentence),
        'objective' => \Str::title($faker->unique()->sentence),
        'sortOrder' => $max+1
    ];
});
