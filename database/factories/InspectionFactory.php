<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inspection;
use Faker\Generator as Faker;

$factory->define(Inspection::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'queen_seen' => $faker->boolean,
        'larval_seen' => $faker->boolean,
        'young_larval_seen' => $faker->boolean,
        'pollen_arriving' => $faker->numberBetween(0, 100),
        'comb_building' => $faker->numberBetween(0, 100),
        'notes' => $faker->text,
        'hive_id' => factory(\App\Hive::class),
        'user_id' => factory(\App\User::class),
    ];
});
