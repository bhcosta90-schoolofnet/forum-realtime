<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(5)->create();
        $users->each(function($user){
            $threads = \App\Models\Thread::factory(rand(1, 8))->create(['user_id' => $user->id]);
            $threads->each(function($thread){
                \App\Models\Reply::factory(rand(5, 10))->create(['thread_id' => $thread->id]);
            });
        });
    }
}
