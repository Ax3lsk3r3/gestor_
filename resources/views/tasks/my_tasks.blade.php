@extends('layouts.app')

@section('title', 'Mis Tareas')

@section('content')
<h4 class="title">📋 Mis Tareas Asignadas</h4>

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
        <th>🎯 Estado</th>
        <th>📅 Fecha Límite</th>
        <th>⚙️ Acción</th>
    </tr>
    @foreach($tasks as $i => $task)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>
            @if($task->status == 'pending') ⏳ Pendiente
            @elseif($task->status == 'in_progress') 🔄 En Progreso
            @else ✅ Completada
            @endif
        </td>
        <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Sin fecha' }}</td>
        <td>
            <a href="{{ route('tasks.edit.employee', $task->id) }}" class="edit-btn">✏️ Actualizar</a>
        </td>
    </tr>
    @endforeach
</table>
@else
<h3>📭 No tienes tareas asignadas</h3>
@endif
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(2)");
    active.classList.add("active");
</script>
@endpush
