# Instrucciones de Instalación

## Pasos para poner en funcionamiento el proyecto Laravel

### 1. Verificar que existe el archivo .env

El archivo `.env` ya debe existir en la raíz del proyecto. Verifica que contenga:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_db
DB_USERNAME=root
DB_PASSWORD=
```

Si necesitas cambiar la configuración de la base de datos, edita estos valores según tu configuración local.

### 2. Instalar dependencias (si es necesario)

Si el proyecto no tiene las dependencias instaladas, ejecuta:

```bash
composer install
```

### 3. Generar clave de aplicación (ya hecho)

La clave de la aplicación ya ha sido generada. Si necesitas regenerarla:

```bash
php artisan key:generate
```

### 4. Configuración de la Base de Datos

Tienes dos opciones:

#### Opción A: Usar la base de datos existente (RECOMENDADO)

Si ya tienes la base de datos `task_management_db` con datos, **NO ejecutes migraciones**. El proyecto está configurado para trabajar con las tablas existentes.

Solo asegúrate de que las tablas existan:
- `users` (con campos: id, full_name, username, password, role, created_at, updated_at)
- `tasks` (con campos: id, title, description, assigned_to, due_date, status, created_at, updated_at)
- `notifications` (con campos: id, message, recipient, type, date, is_read)

#### Opción B: Crear tablas nuevas (PERDERÁS DATOS EXISTENTES)

Si quieres recrear las tablas desde cero:

```bash
php artisan migrate:fresh
```

**ADVERTENCIA:** Esto eliminará todos los datos existentes.

### 5. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

### 6. Iniciar sesión

Accede a: `http://localhost:8000/login`

**Credenciales de Admin (según la base de datos original):**
- Usuario: `admin`
- Contraseña: `123`

**Credenciales de Empleado (según la base de datos original):**
- Usuario: `john`
- Contraseña: `123`

## Verificación del Sistema

### Verificar rutas

```bash
php artisan route:list
```

### Verificar migraciones aplicadas

```bash
php artisan migrate:status
```

### Limpiar caché si hay problemas

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Solución de Problemas Comunes

### Error: "SQLSTATE[HY000] [1049] Unknown database"

La base de datos no existe. Créala en MySQL:

```sql
CREATE DATABASE task_management_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Luego importa el archivo SQL si tienes uno:

```bash
mysql -u root -p task_management_db < gestor/gestiones/task_management_db.sql
```

### Error: "Class 'App\Models\User' not found"

Ejecuta:

```bash
composer dump-autoload
```

### Error: "The only supported ciphers are AES-128-CBC and AES-256-CBC"

Ejecuta:

```bash
php artisan key:generate
```

### Error en las vistas Blade

Limpia la caché de vistas:

```bash
php artisan view:clear
```

## Estructura de Permisos

### Rutas de Admin:
- Dashboard
- Gestionar Usuarios (CRUD completo)
- Crear Tareas
- Ver Todas las Tareas (con filtros)
- Editar/Eliminar Tareas
- Perfil

### Rutas de Employee:
- Dashboard (solo sus tareas)
- Mis Tareas
- Actualizar estado de sus tareas
- Notificaciones
- Perfil

## Próximos Pasos

Una vez que confirmes que el proyecto Laravel funciona correctamente:

1. Prueba todas las funcionalidades
2. Verifica que los datos se muestren correctamente
3. Prueba crear, editar y eliminar registros
4. Si todo funciona bien, puedes eliminar la carpeta `gestiones` con el proyecto antiguo:

```bash
rm -rf gestiones
```

O en Windows:

```powershell
Remove-Item -Recurse -Force gestiones
```

## Soporte

Si encuentras algún problema, verifica:
1. Los logs de Laravel en `storage/logs/laravel.log`
2. Los errores de PHP en la consola donde ejecutaste `php artisan serve`
3. Los errores de JavaScript en la consola del navegador (F12)



