<?php

namespace App\Activity\Repositories;

use App\Activity\ActivityInterface;

interface ActivityRepositoryInterface
{
    public function all();

    public function get(int $id);

    public function getByIds(array $ids): array;

    public function store(ActivityInterface $activity);
}