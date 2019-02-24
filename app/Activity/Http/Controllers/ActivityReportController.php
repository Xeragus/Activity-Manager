<?php

namespace App\Http\Controllers;

use App\Activity\ActivityList\ActivityListInterface;
use App\Activity\Requests\ActivityReportRequest;
use App\Activity\Requests\EmailUrlToUserRequest;
use Carbon\Carbon;

class ActivityReportController extends Controller
{
    public function dashboard()
    {
        return view('activities.report');
    }

    public function report(ActivityReportRequest $request, ActivityListInterface $activityList)
    {
        $data = $request->all();
        $error = false;
        $message = '';
        $activities = [];

        try {
            $dateTimeParts = explode(' - ', $data['datetime_range']);
            $dateTimeTimestampFrom = Carbon::parse($dateTimeParts[0])->getTimestamp();
            $dateTimeTimestampTo = Carbon::parse($dateTimeParts[1])->getTimestamp();

            $activityList->filterByUser(auth()->user()->id);
            $activityList->filterByDatetimeRange($dateTimeTimestampFrom, $dateTimeTimestampTo);

            $activities = $activityList->getResults();

            $message = count($activities) > 0
                ? 'Report is generated successfully'
                    : 'No activities in the selected datetime range';

        } catch(\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
            'activities' => $activities
        ]);
    }

    public function emailUrlToUser(EmailUrlToUserRequest $request)
    {
        $data = $request->all();
        $error = false;
        $message = '';
        $activities = [];

        try {


            $message = 'Unique access URL sent to the following e-mail address: ' . $data['email'];
        } catch(\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }

        return response()->json([
            'error' => $error,
            'message' => $message
        ]);

    }
}