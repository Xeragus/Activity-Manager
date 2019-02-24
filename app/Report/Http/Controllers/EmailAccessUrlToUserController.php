<?php

namespace App\Http\Controllers;

use App\Activity\Requests\EmailUrlToUserRequest;
use App\Report\Commands\EmailAccessUrlToUserCommand;
use Illuminate\Contracts\Bus\Dispatcher;

class EmailAccessUrlToUserController extends Controller
{
    public function emailUrlToUser(EmailUrlToUserRequest $request, Dispatcher $commandBus)
    {
        $data = $request->all();
        $error = false;
        $activities = [];

        try {
            $commandBus->dispatch(new EmailAccessUrlToUserCommand($data));

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