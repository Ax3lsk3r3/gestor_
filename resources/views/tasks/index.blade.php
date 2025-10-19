@extends('layouts.app')

@section('title', 'Todas las Tareas')

@section('content')
<h4 class="title-2">
    <a href="{{ route('tasks.create') }}" class="btn">➕ Crear Tarea</a>
    <a href="{{ route('tasks.calendar') }}" class="btn">📅 Calendario</a>
    <a href="{{ route('tasks.kanban') }}" class="btn">📊 Kanban</a>
    <a href="{{ route('tasks.index', ['due_date' => 'Due Today']) }}">⏰ Vencen Hoy</a>
    <a href="{{ route('tasks.index', ['due_date' => 'Overdue']) }}">⚠️ Vencidas</a>
    <a href="{{ route('tasks.index', ['due_date' => 'No Deadline']) }}">📅 Sin Fecha Límite</a>
    <a href="{{ route('tasks.index') }}">📋 Todas</a>
</h4>

<div class="filter-section">
    <form method="GET" action="{{ route('tasks.index') }}" style="display: flex; gap: 10px; align-items: center; margin: 15px 0;">
        <label for="employee-filter" style="font-weight: bold;">👤 Filtrar por Empleado:</label>
        <select name="employee" id="employee-filter" style="padding: 8px 12px; border-radius: 8px; border: 2px solid var(--blue);">
            <option value="">Todos los empleados</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('employee') == $user->id ? 'selected' : '' }}>
                    {{ $user->full_name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn">🔍 Filtrar</button>
        @if(request('employee'))
            <a href="{{ route('tasks.index') }}" class="btn" style="background: var(--pink);">✖️ Limpiar</a>
        @endif
    </form>
</div>

<h4 class="title-2">{{ $text }} ({{ $num_task }})</h4>

@if(session('success'))
<div class="success" role="alert">
    ✅ {{ session('success') }}
</div>
@endif

@if($tasks->count() > 0)
<table class="main-table">
    <tr>
        <th>#</th>
        <th>📝 Título</th>
        <th>📄 Descripción</th>
        <th>👤 Asignado a</th>
        <th>📅 Fecha Límite</th>
        <th>🎯 Estado</th>
        <th>⚙️ Acciones</th>
    </tr>
    @foreach($tasks as $i => $task)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>{{ $task->assignedUser ? $task->assignedUser->full_name : 'N/A' }}</td>
        <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Sin fecha límite' }}</td>
        <td>
            @if($task->status == 'pending') ⏳ Pendiente
            @elseif($task->status == 'in_progress') 🔄 En Progreso
            @else ✅ Completada
            @endif
        </td>
        <td>
            <a href="{{ route('tasks.edit', $task->id) }}" class="edit-btn">✏️ Editar</a>
            <a href="{{ route('tasks.destroy', $task->id) }}" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">🗑️ Eliminar</a>
        </td>
    </tr>
    @endforeach
</table>
@else
<h3>📭 No hay tareas para mostrar</h3>
@endif
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(4)");
    active.classList.add("active");
</script>
@endpush
