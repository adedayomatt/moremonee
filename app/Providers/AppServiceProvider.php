<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
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
    public function boot(): void
    {

        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share([
            'errors' => function () {
                return self::shareErrors();
            },
            'status' => function () {
                return Session::get('status');
            },
            'error' => function () {
                return Session::get('error');
            },
            'business' => function () {
                return [
                    'name' => config('business.name'),
                    'website' => config('business.website'),
                ];
            },
            'app_name' => config('app.name'),
        ]);
    }

    public static function shareErrors()
    {
            if (!Session::get('errors')) return (object)[];
            $messages = Session::get('errors')->getBag('default')->getMessages();
            $bag = \request()->old('_bag');

            if ($bag) return [
                'bag' => $bag,
                'errors' => $messages,
            ];

            return $messages;
    }



}
