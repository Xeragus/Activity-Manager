<?php

namespace App\Http\Controllers;

use App\Activity\ActivityList\ActivityListInterface;
use App\Activity\Requests\ActivityReportRequest;
use App\Activity\Services\ActivitiesFilterServiceInterface;
use App\Report\Commands\GenerateReportCommand;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

class ActivityReportController extends Controller
{
    public function dashboard()
    {
        return view('activities.report');
    }

    public function report(
        ActivityReportRequest $request,
        ActivityListInterface $activityList,
        EventsDispatcher $eventsDispatcher,
        Dispatcher $commandBus,
        ActivitiesFilterServiceInterface $activitiesFilterService
    ){
        $data = $request->all();
        $error = false;
        $activities = [];
        $url = '';

        try {
            $activities = $activitiesFilterService->filterActivities($data);

            if (count($activities) > 0) {
                $url = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(64/strlen($x)) )),1,64);
                $commandBus->dispatch(new GenerateReportCommand($activities, $url));
            }

            $message = count($activities) > 0 ?
                'Report is generated successfully' :
                    'No activities in the selected datetime range';

        } catch(\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
            'activities' => $activities,
            'url' => $url
        ]);
    }
}