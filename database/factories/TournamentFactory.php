<?php

use App\Tournament;
use Faker\Generator as Faker;

$factory->define(Tournament::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'date_init'=>$faker->date(),
        'date_end'=>  $faker->date(),
        'type' => $faker->randomElement(['Male', 'Female']),
        'logo'=>'logo.png',
        'status'=> $faker->numberBetween(0, 1),
        'rules'=> $faker->text,
        'sports_id' => $faker->numberBetween(1, 3),
        'organizations_id'=> $faker->numberBetween(1, 2)
    ];
});
