<?php

namespace App\Activity\ActivityList;

interface ActivityListInterface
{
    public function filterByUser(int $id);

    public function filterByDatetimeRange(int $fromDatetimeTimestamp, int $toDatetimeTimestamp);

    public function getResults(): array;
}