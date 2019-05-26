<?php

use Faker\Generator as Faker;
use App\Specialty;

$factory->define(Specialty::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle
    ];
});
