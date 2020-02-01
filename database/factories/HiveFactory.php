<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hive;
use Faker\Generator as Faker;

$factory->define(Hive::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'location' => $faker->city,
        'user_id' => factory(\App\User::class),
    ];
});
