<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $data = [
                'num_users' => User::where('role', 'employee')->count(),
                'num_task' => Task::count(),
                'overdue_task' => Task::overdue()->count(),
                'nodeadline_task' => Task::noDeadline()->count(),
                'todaydue_task' => Task::dueToday()->count(),
                'pending' => Task::pending()->count(),
                'in_progress' => Task::inProgress()->count(),
                'completed' => Task::completed()->count(),
            ];
        } else {
            $data = [
                'num_my_task' => Task::where('assigned_to', $user->id)->count(),
                'overdue_task' => Task::overdue()->where('assigned_to', $user->id)->count(),
                'nodeadline_task' => Task::noDeadline()->where('assigned_to', $user->id)->count(),
                'pending' => Task::pending()->where('assigned_to', $user->id)->count(),
                'in_progress' => Task::inProgress()->where('assigned_to', $user->id)->count(),
                'completed' => Task::completed()->where('assigned_to', $user->id)->count(),
            ];
        }

        return view('dashboard.index', $data);
    }
}
