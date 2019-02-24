<?php

namespace App\Report\Services;

use App\Activity\ActivityList\ActivityListInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DailyActivityCalculatorService implements DailyActivityCalculatorServiceInterface
{
    private $activityList;

    public function __construct(ActivityListInterface $activityList)
    {
        $this->activityList = $activityList;
    }

    public function calculateDailyActivityTime($data): array
    {
        $dailyActivities = []; // map: day - time
        $this->activityList->filterByUser(auth()->user()->id);
        $activities = $this->activityList->getResults();

        $dateRangeParts = explode(' - ', $data['date_range']);
        $dateFrom = Carbon::parse($dateRangeParts[0]);
        $dateTo = Carbon::parse($dateRangeParts[1]);
        $days = CarbonPeriod::create($dateFrom->format('Y-m-d'), $dateTo->format('Y-m-d'));

        foreach($activities as $activity) {
            $activityStartDatetime = Carbon::createFromTimestampUTC($activity->getFromDatetime());
            $activityEndDatetime = Carbon::createFromTimestampUTC($activity->getToDatetime());

            foreach ($days as $date) {
                if(
                    $date->format('Y-m-d') == $activityStartDatetime->format('Y-m-d') &&
                    $date->format('Y-m-d') == $activityEndDatetime->format('Y-m-d')
                ) {
                    $timeSpent = $activityStartDatetime->diffInMinutes($activityEndDatetime);

                    if (isset($dailyActivities[$date->format('Y-m-d')])) {
                        $dailyActivities[$date->format('Y-m-d')] += $timeSpent;
                    } else {
                        $dailyActivities[$date->format('Y-m-d')] = $timeSpent;
                    }
                }
                elseif($date->format('Y-m-d') == $activityStartDatetime->format('Y-m-d')) {
                    $startTime = Carbon::parse($activityStartDatetime->format('Y-m-d H:i'));
                    $midnight = Carbon::parse(Carbon::parse($activityStartDatetime)->startOfDay()->format('Y-m-d H:i'))->addDays(1);
                    $timeSpent = $startTime->diffInMinutes($midnight);

                    if (isset($dailyActivities[$date->format('Y-m-d')])) {
                        $dailyActivities[$date->format('Y-m-d')] += $timeSpent;
                    } else {
                        $dailyActivities[$date->format('Y-m-d')] = $timeSpent;
                    }
                } elseif($date->format('Y-m-d') == $activityEndDatetime->format('Y-m-d')) {
                    $startTime = Carbon::parse(Carbon::parse($date)->format('Y-m-d H:i'));
                    $endTime = Carbon::parse(Carbon::parse($activityEndDatetime)->format('Y-m-d H:i'));
                    $timeSpent = $startTime->diffInMinutes($endTime);

                    if (isset($dailyActivities[$date->format('Y-m-d')])) {
                        $dailyActivities[$date->format('Y-m-d')] += $timeSpent;
                    } else {
                        $dailyActivities[$date->format('Y-m-d')] = $timeSpent;
                    }
                }

            }
        }

        return $dailyActivities;
    }
}