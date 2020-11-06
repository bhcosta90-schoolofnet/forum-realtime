<?php

namespace App\Http\Controllers;

use App\Events\NewThreadEvent;
use App\Http\Requests\ThreadRequest;
use App\Models\Thread;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::orderBy('fixed', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate();

        return response()->json($threads);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ThreadRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        $obj = new Thread;
        $obj->title = $request->input('title');
        $obj->body = $request->input('body');
        $obj->user_id = (int) auth()->user()->id;
        $obj->save();

        broadcast(new NewThreadEvent($obj));

        return response()->json([
            'created' => 'success',
            'data' => $obj,
        ], Response::HTTP_CREATED);
    }
    
    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);
        
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ThreadRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->title = $request->input('title');
        $thread->body = $request->input('body');
        $thread->user_id = (int) auth()->user()->id;
        $thread->update();

        return redirect('/threads/' . $thread->id);
    }

    public function fixed(Thread $thread)
    {
        $this->authorize('fixed', $thread);

        $thread->fixed = true;
        $thread->save();

        return response()->json(['updated' => 'success']);
    }

    public function closed(Thread $thread)
    {
        $this->authorize('closed', $thread);
        $thread->closed_at = Carbon::now();
        $thread->save();

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function reopen(Thread $thread)
    {
        $this->authorize('reopen', $thread);

        $thread->closed_at = null;
        $thread->save();

        return response()->json([
            'updated' => 'success',
        ]);
    }
}
