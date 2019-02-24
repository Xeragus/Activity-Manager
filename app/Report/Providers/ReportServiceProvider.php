<?php

namespace App\Report\Providers;

use App\Report\Services\DailyActivityCalculatorService;
use App\Report\Services\DailyActivityCalculatorServiceInterface;
use Illuminate\Support\ServiceProvider;

class ReportServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            DailyActivityCalculatorServiceInterface::class,
            DailyActivityCalculatorService::class
        );
    }
}