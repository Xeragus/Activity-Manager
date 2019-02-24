<?php

namespace App\Activity\Commands;

use App\Activity\ActivityInterface;
use App\Activity\Repositories\ActivityRepositoryInterface;

class StoreActivityCommand
{
    /**
     * @var ActivityInterface
     */
    private $activity;

    public function __construct(ActivityInterface $activity)
    {
        $this->activity = $activity;
    }

    public function handle(ActivityRepositoryInterface $activityRepository)
    {
        $activityRepository->store($this->activity);
    }
}