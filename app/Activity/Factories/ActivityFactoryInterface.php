<?php

namespace App\Activity\Factories;

use App\Activity\ActivityInterface;

interface ActivityFactoryInterface
{
    public function buildActivity(array $data): ActivityInterface;
}