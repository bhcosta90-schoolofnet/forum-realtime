<?php

namespace App\Observers;

use App\Models\Reply;
use Carbon\Carbon;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->thread->reply_count = (int) $reply->thread->reply_count + 1;
        $reply->thread->save();
    }
}
