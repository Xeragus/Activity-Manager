<?php

namespace App\Http\Controllers;

use App\Report\Requests\DailyActivityTimeRequest;
use App\Report\Services\DailyActivityCalculatorServiceInterface;

class ReportPrintController extends Controller
{
    public function display()
    {
        return view('reports.print');
    }

    public function getDailyActivityTime(
        DailyActivityTimeRequest $request,
        DailyActivityCalculatorServiceInterface $activityCalculatorService
    ) {
        $error = false;
        $dailyActivities = [];
        $data = $request->all();

        try {
            $dailyActivities = $activityCalculatorService->calculateDailyActivityTime($data);

            $message = $dailyActivities ?
                'Daily activity times calculated successfully'
                    : 'There are no daily activities for the selected time period';
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
            'dailyActivities' => $dailyActivities
        ]);
    }
}