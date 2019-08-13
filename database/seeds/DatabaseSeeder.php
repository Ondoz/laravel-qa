<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use App\Answer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)->create()->each(function ($u) {
            $u->questions()
                ->saveMany(
                    factory(Question::class, rand(1, 5))->make()
                )
                ->each(function ($q){
                    $q->answers()->saveMany(factory(Answer::class, rand(1, 5))->make());
            });
        });
    }
}
