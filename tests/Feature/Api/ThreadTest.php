<?php

namespace Tests\Feature\Api;

use App\Models\Thread;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function testRoute()
    {
        $user = User::factory()->create();
        
        $response = $this
            ->actingAs($user)
            ->get('/api/threads');

        $response->assertStatus(200);
    }

    public function testIndex()
    {
        $this->seed(DatabaseSeeder::class);

        $threads = Thread::orderBy('updated_at', 'desc')
            ->paginate();
        
        $response = $this
            ->actingAs(User::first())
            ->get('/api/threads');
            
        $response->assertStatus(200)
            ->assertJsonFragment([
                $threads->toArray()['data']
            ]);
    }

    public function testStore()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/threads', [
                'title' => 'Minha primeira postagem',
                'body' => "Minha primeira postagem criação"
            ]);

        $thread = Thread::find(1);
        $thread->user_id = (int) $thread->user_id;

        $response->assertStatus(201)
            ->assertJsonFragment(['created' => 'success'])
            ->assertJsonFragment(['data' => $thread->toArray()]);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $thread = Thread::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->json('PUT', '/api/threads/' . $thread->id, [
                'title' => 'Minha primeira postagem',
                'body' => "Minha primeira postagem edição"
            ]);

        $thread->title = 'Minha primeira postagem';
        $thread->body = 'Minha primeira postagem edição';

        $response->assertStatus(302);
        $this->assertEquals(Thread::find(1)->toArray(), $thread->toArray());
    }
}
