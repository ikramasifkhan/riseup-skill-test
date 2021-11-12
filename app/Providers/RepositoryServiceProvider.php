<?php

namespace App\Providers;

use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\FileInterface;
use App\Repository\Interfaces\PostInterface;
use App\Repository\Interfaces\UserInterface;
use App\Repository\Repos\AdminRepo;
use App\Repository\Repos\FileRepo;
use App\Repository\Repos\PostRepo;
use App\Repository\Repos\UserRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            AdminInterface::class,
            AdminRepo::class,
        );
        $this->app->bind(
            UserInterface::class,
            UserRepo::class,
        );
        $this->app->bind(
            PostInterface::class,
            PostRepo::class,
        );
        $this->app->bind(
            FileInterface::class,
            FileRepo::class,
        );
    }
}
