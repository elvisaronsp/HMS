<?php

use Faker\Generator as Faker;
use App\Doctor;

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'about' => $faker->text(191),
        'specialty_id' => rand(1, 5),
        'phone' => $faker->phoneNumber,
        'avatar' => 'https://myblue.bluecrossma.com/sites/g/files/csphws1461/files/inline-images/Doctor%20Image%20Desktop.png', 
    ];
});
