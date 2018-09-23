<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'content'       => $faker->text,
        'image'         => $faker->imageUrl(552, 552, 'cats', true, $faker->name),
        'video'         => $faker->imageUrl(552, 552, 'cats', true, $faker->name),
        'user_id'       => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'like_count'    => $faker->randomDigitNotNull,
        'comment_count' => $faker->randomDigitNotNull,
        'created_at'    => $faker->date,
        'updated_at'    => $faker->date
    ];
});
