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
        unset($thread->reply_count);
        unset($thread->fixed);
        unset($thread->closed_at);

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
        $thread->user_id = (string) $thread->user_id;

        $compare = Thread::find(1);
        unset($compare->fixed);
        unset($compare->reply_count);
        unset($compare->closed_at);

        $response->assertStatus(302);
        $this->assertEquals($compare->toArray(), $thread->toArray());
    }

    public function testThreadFixed()
    {
        Thread::factory(4)->create();

        $user = User::first();
        $user->role = 'admin';
        $user->save();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/threads/1/fixed', []);
        
        
        $response->assertStatus(200)
            ->assertJsonFragment(['updated' => "success"]);

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/threads/2/fixed', [])
            ->assertJsonFragment(['updated' => "success"]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('threads', [
            'id' => 1,
            'fixed' => true,
        ]);

        $this->assertDatabaseHas('threads', [
            'id' => 2,
            'fixed' => true,
        ]);
    }

    public function testThreadClosed()
    {
        $obj = Thread::factory(4)->create();

        $user = User::first();
        $user->role = 'admin';
        $user->save();

        $response = $this
            ->actingAs($user)
            ->json('DELETE', '/api/threads/1/closed', []);

        $response->assertStatus(204);

        $thread = Thread::where('id', 1)->first();

        $this->assertNotNull($thread->closed_at);
    }

    public function testThreadReopen()
    {
        $obj = Thread::factory(4)->create();

        $user = User::first();
        $user->role = 'admin';
        $user->save();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/threads/1/reopen', []);

        $response->assertStatus(200);

        $thread = Thread::where('id', 1)->first();

        $this->assertNull($thread->closed_at);
    }
}
