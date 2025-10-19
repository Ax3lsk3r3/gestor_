<nav class="side-bar">
    <div class="user-p">
        <img src="{{ asset('img/user.png') }}">
        <h4>{{ Auth::user()->username }}</h4>
    </div>
    
    @if(Auth::user()->isEmployee())
    <!-- Menú de Navegación para Empleados -->
    <ul id="navList">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Inicio</span>
            </a>
        </li>
        <li>
            <a href="{{ route('tasks.my') }}">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <span>Mis Tareas</span>
            </a>
        </li>
        <li>
            <a href="{{ route('profile') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Mi Perfil</span>
            </a>
        </li>
        <li>
            <a href="{{ route('notifications.index') }}">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span>Notificaciones</span>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Cerrar Sesión</span>
            </a>
        </li>
    </ul>
    @else
    <!-- Menú de Navegación para Administrador -->
    <ul id="navList">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Inicio</span>
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Gestionar Usuarios</span>
            </a>
        </li>
        <li>
            <a href="{{ route('tasks.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span>Crear Tarea</span>
            </a>
        </li>
        <li>
            <a href="{{ route('tasks.index') }}">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <span>Todas las Tareas</span>
            </a>
        </li>
        <li>
            <a href="{{ route('tasks.calendar') }}">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <span>Calendario</span>
            </a>
        </li>
        <li>
            <a href="{{ route('tasks.kanban') }}">
                <i class="fa fa-trello" aria-hidden="true"></i>
                <span>Tablero Kanban</span>
            </a>
        </li>
        <li>
            <a href="{{ route('profile') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Mi Perfil</span>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Cerrar Sesión</span>
            </a>
        </li>
    </ul>
    @endif
</nav>
