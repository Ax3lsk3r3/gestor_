@extends('layouts.app')

@section('title', 'Calendario de Tareas')

@section('content')
<div style="margin-bottom: 20px;">
    <h4 class="title-2">
        📅 Calendario de Tareas
        <a href="{{ route('tasks.index') }}" class="btn">📋 Lista</a>
        <a href="{{ route('tasks.kanban') }}" class="btn">📊 Kanban</a>
    </h4>
</div>

<div style="background: var(--white); padding: 20px; border-radius: 15px; box-shadow: 0 8px 30px var(--shadow);">
    <div id="calendar"></div>
</div>

<!-- Modal para mostrar detalles de la tarea -->
<div id="taskModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: var(--white); padding: 30px; border-radius: 15px; max-width: 500px; width: 90%; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
        <h3 id="modalTitle" style="color: var(--accent-blue); margin-bottom: 15px;"></h3>
        <p id="modalDescription" style="margin: 10px 0; color: var(--text-dark);"></p>
        <p id="modalAssigned" style="margin: 10px 0; color: var(--text-dark);"></p>
        <p id="modalStatus" style="margin: 10px 0; color: var(--text-dark);"></p>
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button id="modalEdit" class="edit-btn" style="flex: 1;">✏️ Editar</button>
            <button id="modalClose" class="btn" style="flex: 1; background: var(--pink);">✖️ Cerrar</button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.css" rel="stylesheet">
<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }
    
    .fc {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .fc-toolbar-title {
        color: var(--accent-blue) !important;
        font-weight: 700 !important;
    }
    
    .fc-button {
        background: var(--gradient-2) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 8px 16px !important;
        font-weight: 600 !important;
    }
    
    .fc-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px var(--shadow);
    }
    
    .fc-button-active {
        opacity: 0.8 !important;
    }
    
    .fc-event {
        border-radius: 5px;
        padding: 2px 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .fc-event:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .fc-daygrid-day-number {
        color: var(--text-dark);
        font-weight: 600;
    }
    
    .fc-day-today {
        background: var(--light-blue) !important;
    }

    body.dark-mode #calendar {
        background: #2C3E50;
        border-radius: 10px;
        padding: 20px;
    }

    body.dark-mode .fc-toolbar-title {
        color: #3498DB !important;
    }

    body.dark-mode .fc-col-header-cell {
        background: #34495E !important;
        color: #ECF0F1 !important;
    }

    body.dark-mode .fc-daygrid-day {
        background: #2C3E50 !important;
        border-color: #34495E !important;
    }

    body.dark-mode .fc-daygrid-day-number {
        color: #ECF0F1 !important;
    }

    body.dark-mode .fc-day-today {
        background: #34495E !important;
    }

    body.dark-mode #taskModal > div {
        background: #2C3E50 !important;
        color: #ECF0F1 !important;
    }

    body.dark-mode #modalTitle {
        color: #3498DB !important;
    }

    body.dark-mode #modalDescription,
    body.dark-mode #modalAssigned,
    body.dark-mode #modalStatus {
        color: #ECF0F1 !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var events = @json($events);
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día'
            },
            events: events,
            eventClick: function(info) {
                // Mostrar modal con detalles de la tarea
                document.getElementById('modalTitle').textContent = info.event.title;
                document.getElementById('modalDescription').innerHTML = '<strong>📝 Descripción:</strong> ' + info.event.extendedProps.description;
                document.getElementById('modalAssigned').innerHTML = '<strong>👤 Asignado a:</strong> ' + info.event.extendedProps.assignedTo;
                
                const statusText = {
                    'pending': '⏳ Pendiente',
                    'in_progress': '🔄 En Progreso',
                    'completed': '✅ Completada'
                };
                document.getElementById('modalStatus').innerHTML = '<strong>🎯 Estado:</strong> ' + statusText[info.event.extendedProps.status];
                
                // Configurar botón de editar
                document.getElementById('modalEdit').onclick = function() {
                    window.location.href = '/tasks/' + info.event.id + '/edit';
                };
                
                // Mostrar modal
                document.getElementById('taskModal').style.display = 'flex';
            },
            eventContent: function(arg) {
                return {
                    html: '<div style="font-weight: 600; padding: 2px;">' + arg.event.title + '</div>'
                };
            }
        });
        
        calendar.render();
        
        // Cerrar modal
        document.getElementById('modalClose').onclick = function() {
            document.getElementById('taskModal').style.display = 'none';
        };
        
        // Cerrar modal al hacer clic fuera
        document.getElementById('taskModal').onclick = function(e) {
            if (e.target.id === 'taskModal') {
                document.getElementById('taskModal').style.display = 'none';
            }
        };
    });
</script>
@endpush

@push('scripts')
<script type="text/javascript">
    var active = document.querySelector("#navList li:nth-child(4)");
    active.classList.add("active");
</script>
@endpush

