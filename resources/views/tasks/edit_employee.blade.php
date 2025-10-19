@extends('layouts.app')

@section('title', 'Actualizar Estado')

@section('content')
<h4 class="title">🔄 Actualizar Estado de Tarea <a href="{{ route('tasks.my') }}">📋 Mis Tareas</a></h4>

<form class="form-1" method="POST" action="{{ route('tasks.update.employee', $task->id) }}">
    @csrf
    @method('PUT')

    @if(session('error') || $errors->any())
    <div class="danger" role="alert">
        ⚠️ {{ session('error') ?? $errors->first() }}
    </div>
    @endif

    @if(session('success'))
    <div class="success" role="alert">
        ✅ {{ session('success') }}
    </div>
    @endif

    <div class="input-holder">
        <label>📝 Título</label>
        <input type="text" class="input-1" value="{{ $task->title }}" disabled><br>
    </div>
    <div class="input-holder">
        <label>📄 Descripción</label>
        <textarea rows="5" class="input-1" disabled>{{ $task->description }}</textarea><br>
    </div>
    <div class="input-holder">
        <label>📅 Fecha Límite</label>
        <input type="date" class="input-1" value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}" disabled><br>
    </div>
    
    <div class="input-holder">
        <label>🎯 Estado</label>
        <select name="status" class="input-1">
            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>⏳ Pendiente</option>
            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>🔄 En Progreso</option>
            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>✅ Completada</option>
        </select><br>
    </div>

    <button class="edit-btn">💾 Actualizar Estado</button>
</form>
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(2)");
    active.classList.add("active");
</script>
@endpush
