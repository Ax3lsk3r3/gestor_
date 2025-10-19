# Sistema de Gestión de Tareas - Laravel

Este proyecto ha sido migrado completamente de PHP vanilla a Laravel.

## Configuración Inicial

### 1. Configurar Base de Datos

Edita el archivo `.env` y configura la conexión a tu base de datos MySQL:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_db
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Ejecutar Migraciones

**IMPORTANTE:** La base de datos `task_management_db` ya existe con datos. Si quieres mantener los datos existentes, **NO ejecutes las migraciones**.

Si quieres usar Laravel con la base de datos existente, el proyecto está configurado para trabajar directamente con las tablas actuales.

Si prefieres recrear las tablas desde cero (perderás los datos existentes), ejecuta:

```bash
php artisan migrate:fresh
```

### 3. Crear Usuario Admin (si recreaste la base de datos)

Si ejecutaste las migraciones y perdiste los usuarios, crea uno nuevo con:

```bash
php artisan tinker
```

Luego ejecuta:

```php
\App\Models\User::create([
    'full_name' => 'Administrador',
    'username' => 'admin',
    'password' => bcrypt('123'),
    'role' => 'admin'
]);
```

### 4. Iniciar el Servidor

```bash
php artisan serve
```

Accede a: `http://localhost:8000/login`

## Credenciales de Acceso

### Admin
- Usuario: `admin`
- Password: `123`

### Empleados
- Usuario: `john`
- Password: `123`

## Estructura del Proyecto

### Modelos
- `User` - Usuarios del sistema (admin/employee)
- `Task` - Tareas
- `Notification` - Notificaciones

### Controladores
- `AuthController` - Autenticación
- `DashboardController` - Dashboard principal
- `TaskController` - Gestión de tareas
- `UserController` - Gestión de usuarios
- `NotificationController` - Gestión de notificaciones

### Middleware
- `CheckRole` - Verifica roles (admin/employee)

### Vistas
Todas las vistas están en `resources/views/`:
- `auth/` - Login
- `dashboard/` - Dashboard
- `tasks/` - Gestión de tareas
- `users/` - Gestión de usuarios
- `notifications/` - Notificaciones
- `layouts/` - Plantillas base

## Funcionalidades

### Admin
- Ver dashboard con estadísticas
- Crear, editar y eliminar tareas
- Asignar tareas a empleados
- Gestionar usuarios (crear, editar, eliminar)
- Ver todas las tareas con filtros (Due Today, Overdue, No Deadline)

### Employee
- Ver dashboard con sus estadísticas
- Ver sus tareas asignadas
- Actualizar el estado de sus tareas (pending, in_progress, completed)
- Ver notificaciones
- Editar perfil

## Diferencias con el Proyecto Original

1. **Arquitectura MVC**: El proyecto ahora sigue el patrón MVC de Laravel
2. **ORM Eloquent**: En lugar de PDO, ahora usa Eloquent ORM
3. **Blade Templates**: Las vistas usan el sistema de plantillas Blade
4. **Middleware**: La autenticación y autorización usan middleware de Laravel
5. **Rutas nombradas**: Todas las URLs usan rutas nombradas
6. **Validación**: Las validaciones usan el sistema de Laravel
7. **Seguridad**: Password hashing automático con bcrypt

## Mantenimiento

### Limpiar caché
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Ver rutas disponibles
```bash
php artisan route:list
```

## Notas Importantes

- La carpeta `gestiones` contiene el proyecto original y puede ser eliminada una vez que confirmes que el nuevo proyecto Laravel funciona correctamente
- El sistema mantiene toda la funcionalidad del proyecto original
- Las contraseñas se almacenan de forma segura usando bcrypt
- El sistema de sesiones de Laravel maneja la autenticación automáticamente



