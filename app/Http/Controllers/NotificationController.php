<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('recipient', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function getList()
    {
        $notifications = Notification::where('recipient', Auth::id())
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('notifications.list', compact('notifications'));
    }

    public function count()
    {
        $count = Notification::where('recipient', Auth::id())
            ->where('is_read', 0)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('recipient', Auth::id())
            ->firstOrFail();

        $notification->markAsRead();

        return redirect()->route('notifications.index');
    }
}
