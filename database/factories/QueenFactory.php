<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Queen;
use Faker\Generator as Faker;

$factory->define(Queen::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'race' => $faker->word,
        'marking' => $faker->word,
        'user_id' => factory(\App\User::class),
    ];
});
