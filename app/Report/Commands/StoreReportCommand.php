<?php

namespace App\Report\Commands;

use App\Report\Events\ReportWasStoredEvent;
use App\Report\ReportInterface;
use App\Report\Repositories\ReportRepositoryInterface;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

class StoreReportCommand
{
    /**
     * @var ReportInterface
     */
    private $report;

    public function __construct(ReportInterface $report){
        $this->report = $report;
    }

    public function handle(ReportRepositoryInterface $reportRepository){
        $reportRepository->store($this->report);
    }
}