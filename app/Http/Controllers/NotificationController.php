<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    public function notify()
    {
        if (auth()->user()) {
            auth()->user()->notify(new Notification(auth()->user()->id));
        }
        event(new NotificationEvent('test'));
        return back();
    }
}
