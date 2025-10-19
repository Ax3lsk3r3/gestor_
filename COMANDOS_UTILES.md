# Comandos Útiles - Laravel

## 🚀 Inicio Rápido

### Windows
```bash
start.bat
```

### Manual
```bash
php artisan serve
```

Acceder a: http://localhost:8000/login

## 🔧 Comandos de Artisan

### Base de Datos

```bash
# Ver estado de migraciones
php artisan migrate:status

# Ejecutar migraciones pendientes
php artisan migrate

# Revertir última migración
php artisan migrate:rollback

# Recrear base de datos (CUIDADO: elimina todos los datos)
php artisan migrate:fresh

# Ver consultas SQL en tiempo real (requiere configuración)
php artisan db:show
```

### Caché

```bash
# Limpiar toda la caché
php artisan optimize:clear

# Limpiar caché específica
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Crear caché (para producción)
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Información del Sistema

```bash
# Ver todas las rutas
php artisan route:list

# Ver rutas de un controlador específico
php artisan route:list --name=tasks

# Ver información de Laravel
php artisan about

# Ver información de la base de datos
php artisan db:show
```

### Creación de Archivos

```bash
# Crear un controlador
php artisan make:controller NombreController

# Crear un modelo
php artisan make:model NombreModelo

# Crear un modelo con migración
php artisan make:model NombreModelo -m

# Crear una migración
php artisan make:migration crear_nombre_tabla

# Crear un middleware
php artisan make:middleware NombreMiddleware

# Crear una vista
# No hay comando, crear manualmente en resources/views/
```

### Tinker (Consola Interactiva)

```bash
# Abrir tinker
php artisan tinker

# Dentro de tinker, ejemplos:

# Crear un usuario
\App\Models\User::create([
    'full_name' => 'Test User',
    'username' => 'testuser',
    'password' => bcrypt('password'),
    'role' => 'employee'
]);

# Ver todos los usuarios
\App\Models\User::all();

# Encontrar un usuario
\App\Models\User::find(1);

# Ver tareas de un usuario
\App\Models\User::find(2)->tasks;

# Contar tareas
\App\Models\Task::count();

# Ver tareas overdue
\App\Models\Task::overdue()->get();

# Salir de tinker
exit
```

## 🐛 Debugging

### Ver Logs

```bash
# Ver últimas líneas del log
tail -f storage/logs/laravel.log

# En Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 50 -Wait
```

### Modo Debug

En `.env`:
```
APP_DEBUG=true
```

### Ver Consultas SQL

En tu código:
```php
\DB::enableQueryLog();
// ... tu código ...
dd(\DB::getQueryLog());
```

## 📊 Base de Datos

### Conexión MySQL

```bash
# Conectar a MySQL
mysql -u root -p

# Dentro de MySQL:
USE task_management_db;
SHOW TABLES;
SELECT * FROM users;
SELECT * FROM tasks;
SELECT * FROM notifications;
```

### Backup de Base de Datos

```bash
# Crear backup
mysqldump -u root -p task_management_db > backup.sql

# Restaurar backup
mysql -u root -p task_management_db < backup.sql
```

## 🔐 Seguridad

### Generar Nueva Clave de Aplicación

```bash
php artisan key:generate
```

### Hash de Passwords

En tinker:
```php
bcrypt('mi_password');
```

## 🧪 Testing

```bash
# Ejecutar todos los tests
php artisan test

# Ejecutar un test específico
php artisan test --filter=NombreDelTest
```

## 📦 Composer

```bash
# Instalar dependencias
composer install

# Actualizar dependencias
composer update

# Agregar una dependencia
composer require nombre/paquete

# Regenerar autoload
composer dump-autoload
```

## 🌐 Producción

### Optimización para Producción

```bash
# 1. Cambiar modo debug en .env
APP_DEBUG=false
APP_ENV=production

# 2. Optimizar configuración
php artisan config:cache

# 3. Optimizar rutas
php artisan route:cache

# 4. Optimizar vistas
php artisan view:cache

# 5. Optimizar autoload de Composer
composer install --optimize-autoloader --no-dev
```

### Mantenimiento

```bash
# Poner la aplicación en modo mantenimiento
php artisan down

# Mensaje personalizado
php artisan down --message="Updating system" --retry=60

# Quitar modo mantenimiento
php artisan up
```

## 🔄 Actualización de Datos

### Crear Usuario Admin

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'full_name' => 'Administrator',
    'username' => 'admin',
    'password' => bcrypt('password123'),
    'role' => 'admin'
]);
```

### Crear Usuario Empleado

```php
\App\Models\User::create([
    'full_name' => 'John Doe',
    'username' => 'john',
    'password' => bcrypt('password123'),
    'role' => 'employee'
]);
```

### Actualizar Password de Usuario

```php
$user = \App\Models\User::where('username', 'admin')->first();
$user->password = bcrypt('nueva_password');
$user->save();
```

## 📝 Archivos de Log

### Ubicación
```
storage/logs/laravel.log
```

### Limpiar Logs

```bash
# Windows
del storage\logs\laravel.log

# Linux/Mac
rm storage/logs/laravel.log
```

## ⚡ Atajos Útiles

### Servidor de Desarrollo con Puerto Específico

```bash
php artisan serve --port=8080
```

### Servidor de Desarrollo en Host Específico

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### Ver Versión de Laravel

```bash
php artisan --version
```

### Ver Ayuda de un Comando

```bash
php artisan help migrate
```

## 🆘 Solución Rápida de Problemas

```bash
# Si algo no funciona, ejecuta estos comandos en orden:
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
php artisan serve
```

## 📚 Recursos

- Documentación Laravel: https://laravel.com/docs
- Laracasts (tutoriales): https://laracasts.com
- Laravel News: https://laravel-news.com



