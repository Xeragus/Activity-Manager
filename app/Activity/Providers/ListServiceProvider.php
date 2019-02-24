<?php

namespace App\Activity\Providers;

use App\Activity\ActivityList\ActivityListInterface;
use App\Activity\ActivityList\EloquentActivityList;
use Illuminate\Support\ServiceProvider;

class ListServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ActivityListInterface::class,
            EloquentActivityList::class
        );
    }
}