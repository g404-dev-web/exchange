<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use Tests\TestCase;

class QuestionSearchTest extends TestCase
{
    public function test_search_question()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create([
            "user_id" => $user->id,
            "title" => "Test question to be searched"
        ]);

        $this
            ->actingAs($user);
    }
}
