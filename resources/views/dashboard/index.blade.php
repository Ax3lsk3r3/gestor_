@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
@if(Auth::user()->isAdmin())
<div class="dashboard">
    <div class="dashboard-item">
        <i class="fa fa-users"></i>
        <span>{{ $num_users }} Empleados</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-tasks"></i>
        <span>{{ $num_task }} Tareas Totales</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-window-close-o"></i>
        <span>{{ $overdue_task }} Vencidas</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-clock-o"></i>
        <span>{{ $nodeadline_task }} Sin Fecha Límite</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-exclamation-triangle"></i>
        <span>{{ $todaydue_task }} Vencen Hoy</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-bell"></i>
        <span>{{ $overdue_task }} Notificaciones</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-square-o"></i>
        <span>{{ $pending }} Pendientes</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-spinner"></i>
        <span>{{ $in_progress }} En Progreso</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-check-square-o"></i>
        <span>{{ $completed }} Completadas</span>
    </div>
</div>
@else
<div class="dashboard">
    <div class="dashboard-item">
        <i class="fa fa-tasks"></i>
        <span>{{ $num_my_task }} Mis Tareas</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-window-close-o"></i>
        <span>{{ $overdue_task }} Vencidas</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-clock-o"></i>
        <span>{{ $nodeadline_task }} Sin Fecha Límite</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-square-o"></i>
        <span>{{ $pending }} Pendientes</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-spinner"></i>
        <span>{{ $in_progress }} En Progreso</span>
    </div>
    <div class="dashboard-item">
        <i class="fa fa-check-square-o"></i>
        <span>{{ $completed }} Completadas</span>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(1)");
    active.classList.add("active");
</script>
@endpush
