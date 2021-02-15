<?php

use Faker\Generator as Faker;


$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name'=> $faker->unique()->sentence($nbWords = 6, $variableNbWords = true),
        'description'=>$faker->sentence(),
        'price'=>$faker->numberBetween(1,100),
        'cost'=>$faker->numberBetween(1,100),
        'stock'=>$faker->randomDigit(),
    ];
});
