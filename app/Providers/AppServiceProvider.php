<?php

namespace App\Providers;

use App\Models\{Reply, User};
use App\Observers\{PhotoUserObserver, ReplyObserver};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(Request $request)
    {
        Schema::defaultStringLength(191);

        if (env('REDIRECT_HTTP') || $request->getHost() == 'bhcosta90-forum-realtime.herokuapp.com') {
            \URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Reply::observe(ReplyObserver::class);
        User::observe(PhotoUserObserver::class);
    }
}
