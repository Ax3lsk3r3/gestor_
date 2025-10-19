@extends('layouts.app')

@section('title', 'Gestionar Usuarios')

@section('content')
<h4 class="title">👥 Gestionar Usuarios <a href="{{ route('users.create') }}">➕ Agregar Usuario</a></h4>

@if(session('success'))
<div class="success" role="alert">
    ✅ {{ session('success') }}
</div>
@endif

@if($users->count() > 0)
<table class="main-table">
    <tr>
        <th>#</th>
        <th>👤 Nombre Completo</th>
        <th>🔑 Usuario</th>
        <th>🎯 Rol</th>
        <th>⚙️ Acciones</th>
    </tr>
    @foreach($users as $i => $user)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $user->full_name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->role == 'admin' ? '👑 Administrador' : '👤 Empleado' }}</td>
        <td>
            <a href="{{ route('users.edit', $user->id) }}" class="edit-btn">✏️ Editar</a>
            <a href="{{ route('users.destroy', $user->id) }}" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">🗑️ Eliminar</a>
        </td>
    </tr>
    @endforeach
</table>
@else
<h3>📭 No hay usuarios para mostrar</h3>
@endif
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(2)");
    active.classList.add("active");
</script>
@endpush
