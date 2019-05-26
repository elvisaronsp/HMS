<?php

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
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'birthday' => $faker->date(),
        'gender' => $faker->randomElement(['male', 'female']),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'password' => Hash::make('password'),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'avatar' => $faker->imageUrl( 'http://www.iconninja.com/files/473/667/778/headset-person-man-avatar-support-male-young-icon.png'),
        'blood_type_id' => rand(1, 8)
    ];
});
