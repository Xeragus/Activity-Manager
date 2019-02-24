<?php

namespace App\Activity\Providers;

use App\Activity\Factories\ActivityFactory;
use App\Activity\Factories\ActivityFactoryInterface;
use Illuminate\Support\ServiceProvider;

class FactoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ActivityFactoryInterface::class,
            ActivityFactory::class
        );
    }
}