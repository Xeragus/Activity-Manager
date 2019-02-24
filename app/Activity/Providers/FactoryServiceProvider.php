<?php
/**
 * Created by PhpStorm.
 * User: gsixdev
 * Date: 24.2.19
 * Time: 12:21
 */

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