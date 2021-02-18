<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'names' => $faker->name(),
        'surnames' => $faker->lastName,
        'address' => $faker->address,
        'birthdate' =>  $faker->date($format = 'Y-m-d', $max = '2003-12-31'),
        'phone' => $faker->phoneNumber,
        'identification_card' => $faker->unique()->ean13,
        'email' => $faker->unique()->safeEmail,
    ];
});
