<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\HiveType;
use Faker\Generator as Faker;

$factory->define(HiveType::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'user_id' => factory(\App\User::class),
    ];
});
