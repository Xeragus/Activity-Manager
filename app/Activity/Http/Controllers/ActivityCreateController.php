<?php

namespace App\Http\Controllers;

use App\Activity\Commands\StoreActivityCommand;
use App\Activity\Factories\ActivityFactoryInterface;
use App\Activity\Requests\CreateActivityRequest;
use Illuminate\Contracts\Bus\Dispatcher;

class ActivityCreateController extends Controller
{
    public function createForm()
    {
        return view('activities.create');
    }

    public function create(
        CreateActivityRequest $request,
        ActivityFactoryInterface $activityFactory,
        Dispatcher $commandBus
    ) {
        $error = false;
        $message = '';
        $data = $request->all();

        try {
            $activity = $activityFactory->buildActivity($data);

            $commandBus->dispatch(new StoreActivityCommand($activity));

            $message = 'Activity created successfully';
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }

        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }
}