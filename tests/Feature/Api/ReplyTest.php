<?php

namespace Tests\Feature\Api;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function testListagemDeRespostaPorTopico()
    {
        $this->seed(DatabaseSeeder::class);
        $user = User::first();

        $replies = \App\Models\Reply::with('user')->where('thread_id', 2);
        
        $response = $this
            ->actingAs($user)
            ->json('GET', '/api/replies/2');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => $replies->get()->toArray()
            ]);
    }

    public function testCadastrarRespostaNoTopico()
    {
        Thread::factory()->create();
        $user = User::first();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/replies/1', [
                'reply_body' => 'Oi tudo bem com voce, hahahaheuhudahw'
            ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'created' => "success"
            ])
            ->assertJson([
                'data' => Reply::first()->toArray(),
            ]);
    }
}
