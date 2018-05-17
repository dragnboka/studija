<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Subject::class, function (Faker $faker) {
    return [
        'ime' => $faker->firstName,
        'prezime' => $faker->lastName,
        'srednje' => $faker->firstName,
        'rodjen' => $faker->date,
        'pol' => $faker->randomElement($array = array ('m','f')),
        'komentar' => $faker->paragraph,
        
    ];
});
