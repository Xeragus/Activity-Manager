<?php

namespace App\Activity\Services;

use App\Activity\ActivityList\ActivityListInterface;
use Carbon\Carbon;

class ActivitiesFilterService implements ActivitiesFilterServiceInterface
{
    private $activityList;

    public function __construct(ActivityListInterface $activityList)
    {
        $this->activityList = $activityList;
    }

    public function filterActivities(array $data): array
    {
        $dateTimeParts = explode(' - ', $data['datetime_range']);
        $dateTimeTimestampFrom = Carbon::parse($dateTimeParts[0])->getTimestamp();
        $dateTimeTimestampTo = Carbon::parse($dateTimeParts[1])->getTimestamp();

        $this->activityList->filterByUser(auth()->user()->id);
        $this->activityList->filterByDatetimeRange($dateTimeTimestampFrom, $dateTimeTimestampTo);

        return $this->activityList->getResults();
    }
}