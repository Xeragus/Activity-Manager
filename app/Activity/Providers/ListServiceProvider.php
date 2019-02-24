<?php

namespace App\Activity\Providers;

use App\Activity\ActivityList\ActivityListInterface;
use App\Activity\ActivityList\EloquentActivityList;
use App\Activity\Services\ActivitiesFilterService;
use App\Activity\Services\ActivitiesFilterServiceInterface;
use Illuminate\Support\ServiceProvider;

class ListServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ActivityListInterface::class,
            EloquentActivityList::class
        );

        $this->app->bind(
            ActivitiesFilterServiceInterface::class,
            function ($app) {
                return new ActivitiesFilterService($app->make(ActivityListInterface::class));
            }
        );
    }
}