<?php

namespace App\Report\Commands;

use App\Report\Report;
use Illuminate\Contracts\Bus\Dispatcher;

class GenerateReportCommand
{
    /**
     * @var array
     */
    private $activities;

    private $url;

    public function __construct(array $activities, string $url)
    {
        $this->activities = $activities;
        $this->url = $url;
    }

    public function handle(Dispatcher $commandBus)
    {
        $report = new Report();


        $report->setActivities($this->getCommaSeparatedActivitiesIds($this->activities));
        $report->setUrl($this->url);

        $commandBus->dispatch(new StoreReportCommand($report));
    }

    private function getCommaSeparatedActivitiesIds($activities): string
    {
        $ids = '';

        foreach($activities as $activity) {
            $ids = $ids . $activity->getId() . ',';
        }

        return substr($ids, 0, -1);
    }
}