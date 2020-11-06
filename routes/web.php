<?php

use App\Http\Controllers\{ReplyController, SocialAuthController, ThreadController};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/login/{provider}', [SocialAuthController::class, 'facebookRedirect']);
Route::get('/login/{provider}/callback', [SocialAuthController::class, 'facebookCallback']);

Route::get('/', function () {
    return view('threads.index');
});

Route::get('/threads/{id}', function ($id) {
    $results = \App\Models\Thread::findOrFail($id);
    return view('threads.view', compact('results'));
});

Route::get('/locale/{locale}', function($locale){
    session(['locale' => $locale]);
    return back();
});

Route::get('/threads/{thread}/edit', [ThreadController::class, 'edit'])->middleware(['auth']);

Route::get('/api/threads', [ThreadController::class, 'index']);
Route::get('/api/replies/{thread}', [ReplyController::class, 'show']);

Route::middleware(['auth'])
    ->prefix('api')
    ->group(function(){
        Route::post('/threads', [ThreadController::class, 'store']);
        Route::put('/threads/{thread}', [ThreadController::class, 'update']);
        Route::post('/threads/{thread}/fixed', [ThreadController::class, 'fixed']);
        Route::post('/replies/{thread}', [ReplyController::class, 'store']);
        Route::post('/replies/{reply}/highlighted', [ReplyController::class, 'highlighted']);
    });
