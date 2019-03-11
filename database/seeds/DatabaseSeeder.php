<?php

use App\Question;
use App\User;
use App\Fabric;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Fabric::class, 2)
            ->create()
            ->each(function (Fabric $fabric) {
                factory(User::class, 10)
                    ->create(['fabric_id' => $fabric])
                    ->each(function (User $user) {

                        factory(Question::class, 2)
                            ->create(['user_id' => $user])
                            ->each(function (Question $question) {

                                factory(\App\Answer::class, 2)
                                    ->create([
                                        'question_id' => $question->id,
                                        'user_id' => rand(1,10),
                                    ]);
                            });
                    });
            });

    }
}
