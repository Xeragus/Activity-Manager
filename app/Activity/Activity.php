<?php

namespace App\Activity;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model implements ActivityInterface
{
    public function setDescription(string $description)
    {
        $this->setAttribute('description', $description);
    }

    public function getDescription()
    {
        return $this->getAttribute('description');
    }

    public function setFromDatetime(string $fromDateTime)
    {
        $this->setAttribute('from_datetime', $fromDateTime);
    }

    public function getFromDatetime()
    {
        return $this->getAttribute('from_datetime');
    }

    public function setToDateTime(string $toDateTime)
    {
        $this->setAttribute('to_datetime', $toDateTime);
    }

    public function getToDatetime()
    {
        return $this->getAttribute('to_datetime');
    }

    public function setTimeSpent(string $timeSpent)
    {
        $this->setAttribute('time_spent', $timeSpent);
    }

    public function getTimeSpent()
    {
        return $this->getAttribute('time_spent');
    }
}