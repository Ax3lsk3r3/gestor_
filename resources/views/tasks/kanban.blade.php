@extends('layouts.app')

@section('title', 'Tablero Kanban')

@section('content')
<div style="margin-bottom: 20px;">
    <h4 class="title-2">
        📊 Tablero Kanban
        <a href="{{ route('tasks.index') }}" class="btn">📋 Lista</a>
        <a href="{{ route('tasks.calendar') }}" class="btn">📅 Calendario</a>
    </h4>
</div>

@if(session('success'))
<div class="success" role="alert">
    ✅ {{ session('success') }}
</div>
@endif

<div class="kanban-board">
    <!-- Columna Pendiente -->
    <div class="kanban-column">
        <div class="kanban-header" style="background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%);">
            <h3>⏳ Pendiente</h3>
            <span class="task-count">{{ $pending->count() }}</span>
        </div>
        <div class="kanban-content">
            @forelse($pending as $task)
            <div class="kanban-card" data-task-id="{{ $task->id }}">
                <h4>{{ $task->title }}</h4>
                <p class="task-description">{{ Str::limit($task->description, 80) }}</p>
                <div class="task-meta">
                    <span class="task-user">👤 {{ $task->assignedUser ? $task->assignedUser->full_name : 'N/A' }}</span>
                    @if($task->due_date)
                    <span class="task-date">📅 {{ $task->due_date->format('d/m/Y') }}</span>
                    @endif
                </div>
                <div class="task-actions">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="mini-btn edit-btn">✏️</a>
                    <a href="{{ route('tasks.destroy', $task->id) }}" class="mini-btn delete-btn" onclick="return confirm('¿Eliminar esta tarea?')">🗑️</a>
                </div>
            </div>
            @empty
            <p class="empty-column">No hay tareas pendientes</p>
            @endforelse
        </div>
    </div>

    <!-- Columna En Progreso -->
    <div class="kanban-column">
        <div class="kanban-header" style="background: linear-gradient(135deg, #2196F3 0%, #64B5F6 100%);">
            <h3>🔄 En Progreso</h3>
            <span class="task-count">{{ $inProgress->count() }}</span>
        </div>
        <div class="kanban-content">
            @forelse($inProgress as $task)
            <div class="kanban-card" data-task-id="{{ $task->id }}">
                <h4>{{ $task->title }}</h4>
                <p class="task-description">{{ Str::limit($task->description, 80) }}</p>
                <div class="task-meta">
                    <span class="task-user">👤 {{ $task->assignedUser ? $task->assignedUser->full_name : 'N/A' }}</span>
                    @if($task->due_date)
                    <span class="task-date">📅 {{ $task->due_date->format('d/m/Y') }}</span>
                    @endif
                </div>
                <div class="task-actions">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="mini-btn edit-btn">✏️</a>
                    <a href="{{ route('tasks.destroy', $task->id) }}" class="mini-btn delete-btn" onclick="return confirm('¿Eliminar esta tarea?')">🗑️</a>
                </div>
            </div>
            @empty
            <p class="empty-column">No hay tareas en progreso</p>
            @endforelse
        </div>
    </div>

    <!-- Columna Completada -->
    <div class="kanban-column">
        <div class="kanban-header" style="background: linear-gradient(135deg, #4CAF50 0%, #81C784 100%);">
            <h3>✅ Completada</h3>
            <span class="task-count">{{ $completed->count() }}</span>
        </div>
        <div class="kanban-content">
            @forelse($completed as $task)
            <div class="kanban-card completed" data-task-id="{{ $task->id }}">
                <h4>{{ $task->title }}</h4>
                <p class="task-description">{{ Str::limit($task->description, 80) }}</p>
                <div class="task-meta">
                    <span class="task-user">👤 {{ $task->assignedUser ? $task->assignedUser->full_name : 'N/A' }}</span>
                    @if($task->due_date)
                    <span class="task-date">📅 {{ $task->due_date->format('d/m/Y') }}</span>
                    @endif
                </div>
                <div class="task-actions">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="mini-btn edit-btn">✏️</a>
                    <a href="{{ route('tasks.destroy', $task->id) }}" class="mini-btn delete-btn" onclick="return confirm('¿Eliminar esta tarea?')">🗑️</a>
                </div>
            </div>
            @empty
            <p class="empty-column">No hay tareas completadas</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .kanban-board {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .kanban-column {
        background: var(--white);
        border-radius: 15px;
        box-shadow: 0 8px 30px var(--shadow);
        overflow: hidden;
        min-height: 500px;
        display: flex;
        flex-direction: column;
    }

    .kanban-header {
        padding: 15px 20px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 700;
    }

    .kanban-header h3 {
        margin: 0;
        font-size: 18px;
    }

    .task-count {
        background: rgba(255, 255, 255, 0.3);
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .kanban-content {
        padding: 15px;
        flex: 1;
        overflow-y: auto;
        max-height: 600px;
    }

    .kanban-card {
        background: linear-gradient(135deg, var(--light-blue) 0%, var(--light-pink) 100%);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 12px;
        box-shadow: 0 4px 15px var(--shadow);
        transition: all 0.3s ease;
        border-left: 4px solid var(--accent-blue);
    }

    .kanban-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px var(--shadow);
    }

    .kanban-card.completed {
        opacity: 0.8;
        border-left-color: #4CAF50;
    }

    .kanban-card h4 {
        margin: 0 0 10px 0;
        color: var(--accent-blue);
        font-size: 16px;
        font-weight: 700;
    }

    .task-description {
        color: var(--text-dark);
        font-size: 14px;
        margin: 10px 0;
        line-height: 1.5;
    }

    .task-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0;
        font-size: 13px;
        color: var(--text-dark);
        flex-wrap: wrap;
        gap: 8px;
    }

    .task-user, .task-date {
        background: rgba(168, 216, 234, 0.3);
        padding: 4px 10px;
        border-radius: 15px;
        font-weight: 600;
    }

    .task-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }

    .mini-btn {
        padding: 6px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-block;
        flex: 1;
        text-align: center;
    }

    .mini-btn.edit-btn {
        background: linear-gradient(135deg, var(--accent-blue) 0%, #A8D8EA 100%);
        color: white;
    }

    .mini-btn.delete-btn {
        background: linear-gradient(135deg, var(--accent-pink) 0%, #FFD4E5 100%);
        color: white;
    }

    .mini-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px var(--shadow);
    }

    .empty-column {
        text-align: center;
        color: var(--text-dark);
        opacity: 0.6;
        padding: 40px 20px;
        font-style: italic;
    }

    /* Dark Mode */
    body.dark-mode .kanban-column {
        background: #2C3E50;
    }

    body.dark-mode .kanban-card {
        background: linear-gradient(135deg, #34495E 0%, #4A5F7F 100%);
        border-left-color: #3498DB;
    }

    body.dark-mode .kanban-card h4 {
        color: #3498DB;
    }

    body.dark-mode .task-description,
    body.dark-mode .task-meta {
        color: #ECF0F1;
    }

    body.dark-mode .task-user,
    body.dark-mode .task-date {
        background: rgba(52, 152, 219, 0.2);
    }

    body.dark-mode .empty-column {
        color: #BDC3C7;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .kanban-board {
            grid-template-columns: 1fr;
        }

        .kanban-content {
            max-height: 400px;
        }
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(4)");
    active.classList.add("active");
</script>
@endpush

