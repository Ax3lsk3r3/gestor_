@extends('layouts.app')

@section('title', 'Agregar Usuario')

@section('content')
<h4 class="title">✨ Agregar Nuevo Usuario <a href="{{ route('users.index') }}">👥 Ver Usuarios</a></h4>

<form class="form-1" method="POST" action="{{ route('users.store') }}">
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
        <label>👤 Nombre Completo</label>
        <input type="text" name="full_name" class="input-1" placeholder="Ej: Juan Pérez" value="{{ old('full_name') }}"><br>
    </div>
    <div class="input-holder">
        <label>🔑 Nombre de Usuario</label>
        <input type="text" name="user_name" class="input-1" placeholder="Ej: juan.perez" value="{{ old('user_name') }}"><br>
    </div>
    <div class="input-holder">
        <label>🔒 Contraseña</label>
        <input type="password" name="password" class="input-1" placeholder="Ingresa una contraseña segura"><br>
    </div>
    <button class="edit-btn">💾 Agregar Usuario</button>
</form>
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(2)");
    active.classList.add("active");
</script>
@endpush
