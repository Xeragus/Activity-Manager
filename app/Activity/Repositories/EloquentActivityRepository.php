<?php

namespace App\Activity\Repositories;


use App\Activity\Activity;
use App\Activity\ActivityInterface;

class EloquentActivityRepository implements ActivityRepositoryInterface
{
    public function all()
    {
        return Activity::all() ?? [];
    }

    public function get(int $id)
    {
        return Activity::find($id);
    }

    public function store(ActivityInterface $activity)
    {
        return $activity->save();
    }
}