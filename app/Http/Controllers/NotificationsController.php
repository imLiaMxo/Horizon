<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);
        return view('notifications',[
            'notifications' => $notifications,
        ]);
    }

    public function read($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['redirect']);
        }
    }
}
