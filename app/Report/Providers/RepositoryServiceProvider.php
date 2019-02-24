<?php

namespace App\Report\Providers;

use App\Report\Repositories\EloquentReportRepository;
use App\Report\Repositories\ReportRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ReportRepositoryInterface::class,
            EloquentReportRepository::class
        );
    }
}