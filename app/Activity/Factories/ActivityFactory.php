<?php

namespace App\Activity\Factories;

use App\Activity\Activity;
use App\Activity\ActivityInterface;
use Carbon\Carbon;

class ActivityFactory implements ActivityFactoryInterface
{
    public function buildActivity(array $data): ActivityInterface
    {
        $activity = new Activity();

        $this->fillData($activity, $data);

        return $activity;
    }

    public function fillData(ActivityInterface $activity, array $data)
    {
        $activity->setDescription($data['description']);

        $activity->setUser(auth()->user());

        $dateTimeParts = explode(' - ', $data['datetime_range']);
        $activity->setFromDatetime(Carbon::parse($dateTimeParts[0])->getTimestamp());
        $activity->setToDateTime(Carbon::parse($dateTimeParts[1])->getTimestamp());

        $activity->setTimeSpent($data['time_spent']);
    }
}