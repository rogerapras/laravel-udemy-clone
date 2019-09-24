<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    $encoded = rand(0,1);

    $youtube_link = $faker->randomElement([
        'https://www.youtube.com/watch?v=hdI2bqOjy3c', 
        'https://www.youtube.com/watch?v=Fdf5aTYRW0E', 
        'https://www.youtube.com/watch?v=sBws8MSXN7A'
    ]);

    return [
        'uuid' => (string)\Str::uuid(),
        'is_processed' => true,
        'processing_succeeded' => true,
        'encoded' => $encoded,
        'disk' => $encoded == 1 ? 'local' : 'youtube',
        'streamable_sm' => $encoded ? 'sample_360.mp4' : null,
        'streamable_lg' => $encoded ? 'sample_720.mp4' : null,
        'converted_for_streaming_at' => $encoded ? \Carbon\Carbon::now() : null,
        'original_filename' => $encoded ? 'sample_360.mp4' : null,
        'youtube_link' => $encoded ? null : $youtube_link

    ];
});
