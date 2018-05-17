<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //factory(App\User::class, 10)->create();
        // factory(App\Study::class, 10)
        //    ->create()
        //    ->each(function($s) {
        //         $s->subjects()->attach(factory(App\Subject::class,10)->create()->each(function($g) {
        //             $g->groups()->attach(factory(App\Group::class,1)->create());
        //         }));
        //     });
        // factory(App\Study::class, 10)
        //    ->create()
        //    ->each(function($s) {
        //         $s->subjects()->attach(factory(App\Subject::class,10)->create());
        //     });
        // factory(App\Task::class, 50)->create();
        // factory(App\Group::class, 30)->create();
        //factory(App\Subject::class, 50)->create();
        factory(App\Experiment::class, 200)->create();
    }
}
