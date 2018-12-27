<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use Tests\TestCase;

class QuestionReplyTest extends TestCase
{
    public function test_show_reply_page()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(["user_id" => $user->id]);

        $this
            ->actingAs($user)
            ->get('/questions/'.$question->id)
            ->assertStatus(200)
            ->assertSee('Il n\'y a pas encore de réponse')
            ->assertSee('Répondre')
            ->assertSee('Postez votre Réponse');
    }

    public function test_reply_to_question()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(["user_id" => $user->id]);

        $this
            ->actingAs($user)
            ->post(route('answers.store'), [
                "question_id" => $question->id,
                "description" => 'Test reply description',
            ])
            ->assertStatus(302)
            ->assertRedirect(route('questions.show', $question->id))
            ->assertSessionHas('flash_message', 'Answer added!');
    }
}
