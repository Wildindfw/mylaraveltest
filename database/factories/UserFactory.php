<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'icon' => 'https://picsum.photos/400/?random'.rand(0,500),
       'description' => $faker->sentence,
    ];
});
$factory->define(Profile::class, function (Faker $faker) {
    return [
        'icon' => 'https://picsum.photos/400/?random'.rand(0,500),
        'profile_image' => 'https://picsum.photos/500/200/?random'.rand(0,500),
        'description' => $faker->sentence,
    ];
});


$factory->define(Subreddit::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'icon' => 'https://picsum.photos/400/?random'.rand(0,500),
        'banner' => 'https://picsum.photos/1500/400/?random'.rand(0,500),
    ];
});
