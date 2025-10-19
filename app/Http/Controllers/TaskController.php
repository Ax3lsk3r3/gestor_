<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $text = "Todas las Tareas";
        $query = Task::query()->with('assignedUser')->orderBy('id', 'desc');

        // Filtro por fecha
        if ($request->has('due_date')) {
            switch ($request->due_date) {
                case 'Due Today':
                    $text = "Vencen Hoy";
                    $query->dueToday();
                    break;
                case 'Overdue':
                    $text = "Vencidas";
                    $query->overdue();
                    break;
                case 'No Deadline':
                    $text = "Sin Fecha Límite";
                    $query->noDeadline();
                    break;
            }
        }

        // Filtro por empleado
        if ($request->has('employee') && $request->employee != '') {
            $query->where('assigned_to', $request->employee);
            $employee = User::find($request->employee);
            if ($employee) {
                $text .= " - " . $employee->full_name;
            }
        }

        $tasks = $query->get();
        $num_task = $tasks->count();
        $users = User::where('role', 'employee')->get();

        return view('tasks.index', compact('tasks', 'num_task', 'text', 'users'));
    }

    public function myTasks()
    {
        $tasks = Task::where('assigned_to', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('tasks.my_tasks', compact('tasks'));
    }

    public function create()
    {
        $users = User::where('role', 'employee')->get();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
        ], [
            'title.required' => 'El título es requerido',
            'description.required' => 'La descripción es requerida',
            'assigned_to.required' => 'Debes seleccionar un usuario',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
        ]);

        // Create notification
        Notification::create([
            'message' => "'{$task->title}' has been assigned to you. Please review and start working on it",
            'recipient' => $task->assigned_to,
            'type' => 'New Task Assigned',
            'date' => now(),
        ]);

        return redirect()->route('tasks.create')
            ->with('success', '¡Tarea creada exitosamente!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('role', 'employee')->get();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea actualizada exitosamente!');
    }

    public function editEmployee($id)
    {
        $task = Task::where('id', $id)
            ->where('assigned_to', Auth::id())
            ->firstOrFail();

        return view('tasks.edit_employee', compact('task'));
    }

    public function updateEmployee(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::where('id', $id)
            ->where('assigned_to', Auth::id())
            ->firstOrFail();

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.my')
            ->with('success', '¡Estado de la tarea actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea eliminada exitosamente!');
    }

    public function calendar()
    {
        $tasks = Task::with('assignedUser')
            ->whereNotNull('due_date')
            ->orderBy('due_date', 'asc')
            ->get();

        // Preparar eventos para el calendario en formato JSON
        $events = $tasks->map(function($task) {
            $color = match($task->status) {
                'pending' => '#FFC107',
                'in_progress' => '#2196F3',
                'completed' => '#4CAF50',
                default => '#9E9E9E'
            };

            return [
                'id' => $task->id,
                'title' => $task->title,
                'start' => $task->due_date->format('Y-m-d'),
                'description' => $task->description,
                'assignedTo' => $task->assignedUser ? $task->assignedUser->full_name : 'N/A',
                'status' => $task->status,
                'backgroundColor' => $color,
                'borderColor' => $color,
            ];
        });

        return view('tasks.calendar', compact('events'));
    }

    public function kanban()
    {
        $pending = Task::with('assignedUser')->where('status', 'pending')->orderBy('due_date', 'asc')->get();
        $inProgress = Task::with('assignedUser')->where('status', 'in_progress')->orderBy('due_date', 'asc')->get();
        $completed = Task::with('assignedUser')->where('status', 'completed')->orderBy('due_date', 'asc')->get();

        return view('tasks.kanban', compact('pending', 'inProgress', 'completed'));
    }
}
