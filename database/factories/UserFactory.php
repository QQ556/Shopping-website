<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\shop\Merchandise;
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$lkoF/j1VokwVNa4.Or8uIeiKJwyr0f/YaGdOTVMp7YKlKHKbKivZ2', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Merchandise::class, function (Faker $faker) {
    $photo =  $faker->numberBetween(1, 9);
    return [
        'status' => 'C',
        // 'user_id' => '1',
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'name' => '[中文測試] ' . $faker->name,
        'name_en'    => '[英文測試] ' . $faker->name,
        'introduction'    => '[中文測試] ' . $faker->text($maxNbChars = 2500),
        'introduction_en' => '[英文測試] ' . $faker->text($maxNbChars = 2500),
        //images/merchandise/5d9ae1e2593de.jpg
        'photo'    => 'images/merchandise/' . $photo . '.jpg',
        'price'    => $faker->numberBetween(0, 100),
        'remain_count' => $faker->numberBetween(0, 100),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
