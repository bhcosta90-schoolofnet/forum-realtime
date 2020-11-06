<?php

namespace App\Http\Controllers;

use App\Events\NewReplyEvent;
use App\Models\Reply;
use App\Models\Thread;
use App\Http\Requests\ReplyRequest as Request;
use Illuminate\Http\Response;

class ReplyController extends Controller
{
    public function show(Thread $thread){
        
        $replies = \App\Models\Reply::with('user')->where('thread_id', $thread->id);

        return response()->json([
            'data' => $replies->get()
        ]);
    }

    public function store(Request $request, Thread $thread)
    {
        $obj = new Reply;
        $obj->user_id = auth()->user()->id;
        $obj->thread_id = $thread->id;
        $obj->body = $request->input('reply_body');
        $obj->save();

        broadcast(new NewReplyEvent($obj));

        return response()->json([
            'created' => 'success',
            'data' => $obj
        ], Response::HTTP_CREATED);
    }
}
