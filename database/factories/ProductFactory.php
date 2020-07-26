<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'is_published' => filter_var($faker->numberBetween(0, 1), FILTER_VALIDATE_BOOLEAN),
        'sort' => $faker->numberBetween(1, 500),
        'price' => $faker->randomFloat(4,20, 1000)
    ];
});
