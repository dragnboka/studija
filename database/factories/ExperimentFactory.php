<?php

use Faker\Generator as Faker;

$factory->define(App\Experiment::class, function (Faker $faker) {
    return [
        'subject_id' => $faker->numberBetween($min = 1, $max = 10),
        'task_id' => $faker->numberBetween($min = 1, $max = 10),
        'vreme' => $faker->time,
        'komentar' => $faker->text($maxNbChars = 50),
        
    ];
});
