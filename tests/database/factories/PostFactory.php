<?php

use Bitfumes\Likker\Tests\Models\Post;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
    ];
});
