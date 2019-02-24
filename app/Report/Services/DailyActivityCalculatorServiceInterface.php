<?php

namespace App\Report\Services;

interface DailyActivityCalculatorServiceInterface
{
    public function calculateDailyActivityTime($data);
}