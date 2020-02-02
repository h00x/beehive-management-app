<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hive;
use Faker\Generator as Faker;

$factory->define(Hive::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'user_id' => factory(\App\User::class),
        'apiary_id' => factory(\App\Apiary::class),
    ];
});
