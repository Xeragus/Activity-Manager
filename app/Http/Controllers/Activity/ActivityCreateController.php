<?php

namespace App\Http\Controllers;

class ActivityCreateController extends Controller
{
    public function createForm()
    {
        return view('activities.create');
    }
}