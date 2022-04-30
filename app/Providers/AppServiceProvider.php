<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Multiple values
        Inertia::share([
            // Synchronously
            'app' => [
                'name' => Config::get('app.name'),
                'url' => request()->getHost(),
                'web_url' => env('App_URL', 'mysaas.test'),
                'lang' => 'eng',
            ],

            // Lazily
            'auth' => function () {
                return [
                    'user' => Auth::user() ? Auth::user() : null,
                ];
            },

            'session' => [
                'current' => session('session', []),
            ],
            // 'errors' => function () {
            //     return Session::get('errors')
            //         ? Session::get('errors')->getBag('default')->getMessages()
            //         : (object) [];
            // },
            // 'flash' => function () {
            //     return [
            //         'message' => Session::get('message'),
            //         'success' => Session::get('success'),
            //         'error' => Session::get('error'),
            //     ];
            // }
        ]);
    }
}
