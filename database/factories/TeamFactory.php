<?php

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'type'=>$faker->randomElement(["Male", "Female"]),
        'logo'=> 'logo.png',
        'organization_id'=> $faker->numberBetween(1, 2),
        'sport_id' => $faker->numberBetween(1, 3)
    ];
});

//factory(App\Tournament::class, 5)->create();
