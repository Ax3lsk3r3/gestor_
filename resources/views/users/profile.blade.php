@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<h4 class="title">👤 Mi Perfil <a href="{{ route('profile.edit') }}">✏️ Editar Perfil</a></h4>

@if(session('success'))
<div class="success" role="alert">
    ✅ {{ session('success') }}
</div>
@endif

<table class="main-table" style="max-width: 400px;">
    <tr>
        <td><strong>👤 Nombre Completo</strong></td>
        <td>{{ $user->full_name }}</td>
    </tr>
    <tr>
        <td><strong>🔑 Nombre de Usuario</strong></td>
        <td>{{ $user->username }}</td>
    </tr>
    <tr>
        <td><strong>📅 Miembro Desde</strong></td>
        <td>{{ $user->created_at->format('d/m/Y') }}</td>
    </tr>
</table>
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(3)");
    active.classList.add("active");
</script>
@endpush
