@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<h4 class="title">✏️ Editar Mi Perfil <a href="{{ route('profile') }}">👤 Ver Perfil</a></h4>

<form class="form-1" method="POST" action="{{ route('profile.update') }}">
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
        <label>👤 Nombre Completo</label>
        <input type="text" name="full_name" class="input-1" placeholder="Nombre Completo" value="{{ old('full_name', Auth::user()->full_name) }}"><br>
    </div>
    <div class="input-holder">
        <label>🔒 Nueva Contraseña (dejar vacío para mantener la actual)</label>
        <input type="password" name="password" class="input-1" placeholder="Nueva contraseña (opcional)"><br>
    </div>
    <button class="edit-btn">💾 Actualizar Perfil</button>
</form>
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(3)");
    active.classList.add("active");
</script>
@endpush
