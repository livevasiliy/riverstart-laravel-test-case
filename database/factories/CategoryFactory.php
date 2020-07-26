<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'active' => filter_var($faker->numberBetween(0, 1), FILTER_VALIDATE_BOOLEAN),
        'sort' => $faker->numberBetween(1, 500)
    ];
});
