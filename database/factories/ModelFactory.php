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
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
        'status' => 1,
    ];
});

$factory->define(App\Models\UserProfile::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName(null),
        'last_name' => $faker->lastName(null),
        'ic_number' => str_random(10),
        'passport' => str_random(10),
        'nationality' => str_random(10),
        'emergency_contact_name' => str_random(10),
        'emergency_contact_relationship' => str_random(10),
        'emergency_contact_no' => str_random(10),
        'SnP' => str_random(10),
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => $faker->country,
        'zip' => $faker->postcode,
        'race' => str_random(10),
        'contact_no' => str_random(10),
    ];
});
