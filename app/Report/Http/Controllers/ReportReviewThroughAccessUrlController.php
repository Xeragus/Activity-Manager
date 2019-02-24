<?php

namespace App\Http\Controllers;

use App\Activity\Repositories\ActivityRepositoryInterface;
use App\Report\Repositories\ReportRepositoryInterface;

class ReportReviewThroughAccessUrlController extends Controller
{
    private $reportRepository;
    private $activityRepository;

    public function __construct(ReportRepositoryInterface $reportRepository, ActivityRepositoryInterface $activityRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->activityRepository = $activityRepository;
    }

    public function display(string $url)
    {
        $report = $this->reportRepository->getByAccessUrl($url);
        $activities = $this->activityRepository->getByIds(explode(',', $report->getActivities()));

        return view('reports.display', ['activities' => $activities]);
    }
}