<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class QuestionAskTest extends TestCase
{
    public function test_show_question_creation_page()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->get('/questions/create')
            ->assertStatus(200)
            ->assertSee('Posez votre question')
            ->assertSee('Publiez votre question!');
    }

    public function test_ask_question()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post(route('questions.store'), [
                "title" => 'Test question',
                "category" => 'Test category',
                "description" => 'Test description',
            ])
            ->assertStatus(302)
            ->assertRedirect(route('questions.show', DB::table('questions')->orderBy('id', 'desc')->first()->id))
            ->assertSessionHas('flash_message', 'Question added!');
    }
}
