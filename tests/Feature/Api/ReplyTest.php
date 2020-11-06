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
        
        $reply = Reply::first();
        $reply->user_id = (int) $reply->user_id;
        $reply->thread_id = (int) $reply->thread_id;
        unset($reply->highlighted);
        
        $response->assertStatus(201)
            ->assertJsonFragment([
                'created' => "success"
            ])
            ->assertJson([
                'data' => $reply->toArray(),
            ]);
    }

    public function testRespostaEmDestaque()
    {
        $thread = Thread::factory()->create();
        Reply::factory(2)->create(['thread_id' => $thread->id]);

        $user = User::first();
        $user->role = 'admin';
        $user->save();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/replies/1/highlighted', []);
        
        $response->assertStatus(200)
            ->assertJsonFragment(['updated' => "success"]);

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/replies/2/highlighted', [])
            ->assertJsonFragment(['updated' => "success"]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('replies', [
            'id' => 1,
            'highlighted' => false,
        ]);

        $this->assertDatabaseHas('replies', [
            'id' => 2,
            'highlighted' => true,
        ]);
    }
}
