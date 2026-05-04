<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\FilterRequest;

class NotificationController extends Controller
{
    public function index(FilterRequest $request)
    {
        print_r($request->all());

        return view('notifications.index');
    }
}
