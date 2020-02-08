<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Harvest;
use Faker\Generator as Faker;

$factory->define(Harvest::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'date' => $faker->date('Y-m-d'),
        'batch_code' => $faker->word,
        'weight' => $faker->numberBetween(0, 10000),
        'moister_content' => $faker->numberBetween(0, 100),
        'nectar_source' => $faker->word,
        'description' => $faker->text,
        'user_id' => factory(\App\User::class),
    ];
});
