<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

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
        //Github API Req. generation
        Http::macro('github', function () {
            return Http::withHeaders([
                'Accept' => 'application/vnd.github+json',
                'Authorization' => 'token ' . env('GITHUB_TOKEN')
            ])->baseUrl('https://api.github.com/');
        });
    }
}
