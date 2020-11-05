<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testReplies()
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/threads/1');
        $response->assertStatus(200);

        $response = $this->get('/threads/2');
        $response->assertStatus(200);

        $response = $this->get('/threads/a');
        $response->assertStatus(404);
    }

    public function testThreadsVisualization()
    {
        $this->seed(DatabaseSeeder::class);

        $thread = \App\Models\Thread::find(1);
        
        $response = $this->get('/threads/1');
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }
}
