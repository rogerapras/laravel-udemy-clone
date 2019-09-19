<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $title = \Str::title($faker->unique()->sentence);
    $childrenCategories = \App\Models\Category::whereNotNull('parent_id')->pluck('id');
    return [
        'user_id' => $faker->randomElement([2,3,4,5,6,7,8]), // make this a relationship
        'category_id' => $faker->randomElement($childrenCategories),
        'uuid' => (string)\Str::uuid(),
        'title' => $title,
        'subtitle' => \Str::title($faker->unique()->sentence),
        'slug' => \Str::slug($title),
        'description' => $faker->paragraphs(rand(2,4), true), // true means return as a string and not array
        'language' => $faker->randomElement(['English', 'French', 'Spanish']),
        'level' => $faker->randomElement(['All', 'Beginner', 'Intermediate', 'Advanced']),
        'price' => $faker->numberBetween(0, 200),
        'published' => true,
        'approved' => true
    ];
});


//factory(App\Models\User::class, 3)->create()->each(function ($user) {$user->authored_courses()->save(factory(App\Models\Course::class)->make());});