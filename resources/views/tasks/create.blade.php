@extends('layouts.app')

@section('title', 'Crear Tarea')

@section('content')
<h4 class="title">✨ Crear Nueva Tarea</h4>

<form class="form-1" method="POST" action="{{ route('tasks.store') }}">
    @csrf

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
        <input type="text" name="title" class="input-1" placeholder="Ej: Preparar presentación" value="{{ old('title') }}"><br>
    </div>
    <div class="input-holder">
        <label>📄 Descripción</label>
        <textarea type="text" name="description" class="input-1" placeholder="Describe los detalles de la tarea...">{{ old('description') }}</textarea><br>
    </div>
    <div class="input-holder">
        <label>📅 Fecha Límite</label>
        <input type="date" name="due_date" class="input-1" value="{{ old('due_date') }}"><br>
    </div>
    <div class="input-holder">
        <label>👤 Asignar a</label>
        <select name="assigned_to" class="input-1">
            <option value="">Seleccionar empleado</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                {{ $user->full_name }}
            </option>
            @endforeach
        </select><br>
    </div>
    <button class="edit-btn">💾 Crear Tarea</button>
</form>
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(3)");
    active.classList.add("active");
</script>
@endpush
