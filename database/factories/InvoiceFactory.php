<?php

use Faker\Generator as Faker;

$factory->define(App\Invoice::class, function (Faker $faker) {
    return [
      'subtotal'=>$faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
      'iva'=>$faker->numberBetween(1,100),
      'total'=>$faker->numberBetween(1,100)
    ];
});
