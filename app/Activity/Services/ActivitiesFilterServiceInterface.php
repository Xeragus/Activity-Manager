<?php

namespace App\Activity\Services;

interface ActivitiesFilterServiceInterface
{
    public function filterActivities(array $data): array;
}