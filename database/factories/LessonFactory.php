<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker, $course_id) {
    $type = $faker->randomElement(['video', 'youtube', 'article', null]);
    $max = Lesson::max('id');
    return [
        'course_id' => $course_id,
        //'section_id' => 1,
        'uuid' => (string)\Str::uuid(),
        'lesson_type' => 'lecture',
        'title' => \Str::title($faker->unique()->sentence),
        'description' => $faker->paragraphs(1, true),
        'content_type' => $type,
        'duration' => $type !== null ? $faker->randomFloat($nbMaxDecimals=2, $min= 0.5, $max = 10) : 0.00,
        'article_body' => $type == 'article' ? '<p>' . $faker->paragraph(rand(3,10), true) . '</p><p>' . $faker->paragraph(rand(2,10), true) . '</p>' : null,
        'preview' => $type == 'article' && $type !== null ? rand(0,1) : 0,
        'sortOrder' => $max +1

    ];
});
