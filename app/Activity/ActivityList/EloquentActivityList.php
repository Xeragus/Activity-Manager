<?php

namespace App\Activity\ActivityList;

use App\Activity\Activity;
use Illuminate\Database\Eloquent\Builder as Query;

class EloquentActivityList implements ActivityListInterface
{
    private $userId = null;
    private $fromDatetimeTimestamp = null;
    private $toDatetimeTimestamp = null;

    protected function prepareQuery(): Query {
        $qb = Activity::query();

        $qb->select('activities.*');

        if ($this->userId) {
            $qb->where('activities.user_id', $this->userId);
        }

        if ($this->fromDatetimeTimestamp && $this->toDatetimeTimestamp) {
            $qb->where('activities.from_datetime', '>=', $this->fromDatetimeTimestamp)
            ->where('activities.to_datetime', '<=', $this->toDatetimeTimestamp);
        }

        return $qb;
    }

    public function filterByUser(int $id)
    {
        $this->userId = $id;
    }

    public function filterByDatetimeRange(int $fromDatetimeTimestamp, int $toDatetimeTimestamp)
    {
        $this->fromDatetimeTimestamp = $fromDatetimeTimestamp;
        $this->toDatetimeTimestamp = $toDatetimeTimestamp;
    }

    public function getResults(): array
    {
        $query = $this->prepareQuery();

        return $query->get()->all();
    }
}