<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        // 'email' => $faker->unique()->safeEmail,
        'email' => 'armandoaepp@gmail.com',
        'password' => $password ?: $password = bcrypt('armando'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Marca::class, function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->name,
        'imagen' => '',
        'estado' => 1,
    ];
});
