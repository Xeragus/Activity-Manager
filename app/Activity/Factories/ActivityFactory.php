<?php

namespace App\Activity\Factories;

use App\Activity\Activity;
use App\Activity\ActivityInterface;

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
        $dateTimeParts = explode(' - ', $data['datetime_range']);
        $activity->setFromDatetime($dateTimeParts[0]);
        $activity->setToDateTime($dateTimeParts[1]);
        $activity->setTimeSpent($data['time_spent']);
    }
}