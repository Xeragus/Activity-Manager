<?php

namespace App\Activity\Providers;

use App\Activity\Repositories\ActivityRepositoryInterface;
use App\Activity\Repositories\EloquentActivityRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ActivityRepositoryInterface::class,
            EloquentActivityRepository::class
        );
    }
}