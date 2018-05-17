<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'study_id' => $faker->numberBetween($min = 1, $max = 10),
        'name' => $faker->sentence($nbWords = 2, $variableNbWords = true)   
        
    ];
});
