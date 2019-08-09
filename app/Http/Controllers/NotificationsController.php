<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function clear(Request $request, $notifId = false)
    {
        $notifications = $request->user()->notifications();
        if($notifId)
        {
            $notifications = $notifications->where('id', $notifId);
        }
        $notifications->delete();
    }

    public function get(Request $request)
    {
        return $request->user()->notifications;
    }
}
