<?php

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        //'type'=>$faker->randomElement(["Male", "Female"]),
        'type'=> 'Male',
        'logo'=> 'img/team.png',
        'sport_id' => 1,
        'tournament_id'=> 2
    ];
});

//factory(App\Team::class, 5)->create();
