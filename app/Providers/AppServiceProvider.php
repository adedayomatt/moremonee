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
            'toast' => function () {
                return (object) Session::get('toast');
            },
            'transaction' => function () {
                return Session::get('transaction');
            },
            'config' => function () {
                return [
                    'app_name' => config('app.name'),
                    'logo_url' => config('business.logo'),
                    'business_name' => config('business.name'),
                    'business_website' => config('business.website'),
                    'currencies' => config('business.currencies'),
                    'whatsapp_url' => config('business.whatsapp'),
                    'instagram_url' => config('business.instagram'),
                    'facebook_url' => config('business.facebook'),
                    'allowed_cross_origin_domains' => config('business.allowed_cross_origin_domains'),
                    'enable_multiple_currency' => config('business.enable_multiple_currency'),
                ];
            },
            'tempUser' =>  function () {
                return (object) Session::get('temp-user');
            }
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
