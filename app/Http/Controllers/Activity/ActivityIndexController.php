<?php

namespace App\Http\Controllers;

class ActivityIndexController extends Controller
{
    public function index()
    {
        return view('activities.index');
    }
}