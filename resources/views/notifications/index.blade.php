@extends('layouts.app')

@section('title', 'Notificaciones')

@section('content')
<h4 class="title">🔔 Mis Notificaciones</h4>

@if(session('success'))
<div class="success" role="alert">
    ✅ {{ session('success') }}
</div>
@endif

@if($notifications->count() > 0)
<table class="main-table">
    <tr>
        <th>#</th>
        <th>💬 Mensaje</th>
        <th>🏷️ Tipo</th>
        <th>📅 Fecha</th>
    </tr>
    @foreach($notifications as $i => $notification)
    <tr style="{{ $notification->is_read ? '' : 'background: #E8F4F8; font-weight: 600;' }}">
        <td>{{ $i + 1 }}</td>
        <td>{{ $notification->message }}</td>
        <td>{{ $notification->type }}</td>
        <td>{{ $notification->date->format('d/m/Y') }}</td>
    </tr>
    @endforeach
</table>
@else
<h3>📭 No tienes notificaciones</h3>
@endif
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(4)");
    active.classList.add("active");
</script>
@endpush
