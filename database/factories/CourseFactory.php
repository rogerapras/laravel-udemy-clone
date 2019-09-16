<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $image_download = $faker->image(public_path('uploads/images/course/thumbnails'), 250,240);
    $image_path = explode('\\', $image_download);
    $image_name = end($image_path);

    return [
        'user_id' => '', // make this a relationship
        'uuid' => (string)\Str::uuid(),
        'title' => title_case($faker->unique()->sentence),
        ''
    ];
});
