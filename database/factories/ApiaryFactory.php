<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apiary;
use Faker\Generator as Faker;

$factory->define(Apiary::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'location' => $faker->city,
        'user_id' => factory(\App\User::class),
    ];
});
