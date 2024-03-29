<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hive;
use Faker\Generator as Faker;

$factory->define(Hive::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'user_id' => factory(\App\User::class),
        'apiary_id' => factory(\App\Apiary::class),
        'hive_type_id' => factory(\App\HiveType::class),
        'queen_id' => factory(\App\Queen::class)
    ];
});
