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
        'image' => $faker->imageUrl('http://www.iconninja.com/files/473/667/778/headset-person-man-avatar-support-male-young-icon.png'), 
    ];
});
