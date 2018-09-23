<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'      => $faker->name,
        'firstname' => $faker->firstName,
        'lastname'  => $faker->lastName,
        'email'     => $faker->email,
        'company'   => $faker->company,
        'job'       => $faker->jobTitle,
        'remember_token' => str_random(10),
        'avatar'    => $faker->imageUrl(128, 128, 'cats', true, $faker->md5),
        'password'  => bcrypt('123456')
    ];
});
