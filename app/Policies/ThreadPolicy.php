<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Thread $thread)
    {
        return (int) $user->id === (int) $thread->user_id;
    }

    public function fixed(User $user, Thread $thread, string $role = "admin"){
        return (bool) $user->role == $role;
    }

    public function closed(User $user, Thread $thread, string $role = "admin"){
        return (bool) $user->role == $role;
    }

    public function reopen(User $user, Thread $thread, string $role = "admin"){
        return (bool) $user->role == $role;
    }
}
