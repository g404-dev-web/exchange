<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AskQuestionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAskQuestion()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/question/create');

        $response->assertStatus(200);

    }
}
