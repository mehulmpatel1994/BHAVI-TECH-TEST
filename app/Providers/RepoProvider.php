<?php

namespace App\Providers;

use App\GitRepoServicies\GitRepo;
use App\RepositoryInterfaces\VersionControlRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->bind(VersionControlRepositoryInterface::class, GitRepo::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
