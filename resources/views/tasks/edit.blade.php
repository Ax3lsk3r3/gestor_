@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<h4 class="title">✏️ Editar Tarea <a href="{{ route('tasks.index') }}">📋 Ver Todas</a></h4>

<form class="form-1" method="POST" action="{{ route('tasks.update', $task->id) }}">
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
        <input type="text" name="title" class="input-1" placeholder="Título" value="{{ old('title', $task->title) }}"><br>
    </div>
    <div class="input-holder">
        <label>📄 Descripción</label>
        <textarea name="description" rows="5" class="input-1">{{ old('description', $task->description) }}</textarea><br>
    </div>
    <div class="input-holder">
        <label>📅 Fecha Límite</label>
        <input type="date" name="due_date" class="input-1" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"><br>
    </div>
    
    <div class="input-holder">
        <label>👤 Asignar a</label>
        <select name="assigned_to" class="input-1">
            <option value="">Seleccionar empleado</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" {{ (old('assigned_to', $task->assigned_to) == $user->id) ? 'selected' : '' }}>
                {{ $user->full_name }}
            </option>
            @endforeach
        </select><br>
    </div>

    <button class="edit-btn">💾 Actualizar Tarea</button>
</form>
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(4)");
    active.classList.add("active");
</script>
@endpush
