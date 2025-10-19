# 👥 Usuarios y Credenciales del Sistema

## 📋 Tabla de Usuarios

Según la base de datos `task_management_db`, estos son los usuarios disponibles:

| ID | Nombre Completo | Usuario  | Contraseña | Rol      | Acceso                          |
|----|-----------------|----------|------------|----------|---------------------------------|
| 1  | Oliver          | admin    | **123**    | admin    | ✅ Acceso completo al sistema   |
| 2  | Elias A.        | elias    | **123**    | employee | ✅ Solo sus tareas              |
| 7  | John            | john     | **123**    | employee | ✅ Solo sus tareas              |
| 8  | Oliver          | oliver   | **123**    | employee | ✅ Solo sus tareas              |

---

## 🔐 Credenciales para Login

### 🔴 **ADMIN (Acceso Total)**

```
Usuario: admin
Contraseña: 123
```

**Permisos:**
- ✅ Ver dashboard completo
- ✅ Crear, editar y eliminar tareas
- ✅ Asignar tareas a empleados
- ✅ Crear, editar y eliminar usuarios
- ✅ Ver todas las tareas del sistema
- ✅ Ver perfil y editarlo

---

### 🟢 **EMPLEADOS (Acceso Limitado)**

#### Usuario: john
```
Usuario: john
Contraseña: 123
Rol: employee
```

#### Usuario: elias
```
Usuario: elias
Contraseña: 123
Rol: employee
```

#### Usuario: oliver
```
Usuario: oliver
Contraseña: 123
Rol: employee
```

**Permisos de Empleados:**
- ✅ Ver dashboard personal
- ✅ Ver solo sus tareas asignadas
- ✅ Actualizar estado de sus tareas (pending → in_progress → completed)
- ✅ Ver notificaciones
- ✅ Ver y editar su perfil
- ❌ **NO pueden** crear, editar o eliminar usuarios
- ❌ **NO pueden** ver tareas de otros empleados
- ❌ **NO pueden** crear tareas

---

## 🔧 Cómo Cambiar una Contraseña

Si necesitas cambiar la contraseña de un usuario:

### Opción 1: Usando Tinker (Recomendado)

```bash
php artisan tinker
```

Luego ejecuta:

```php
// Cambiar contraseña del admin
$user = \App\Models\User::where('username', 'admin')->first();
$user->password = bcrypt('nueva_contraseña');
$user->save();
```

### Opción 2: Directamente en MySQL

```sql
-- Conectar a MySQL
mysql -u root -p

USE task_management_db;

-- Generar un hash bcrypt de la contraseña (usa PHP)
-- En PHP: bcrypt('mi_password')

-- Actualizar en la base de datos
UPDATE users 
SET password = '$2y$10$TU_HASH_AQUI' 
WHERE username = 'admin';
```

---

## ➕ Cómo Crear un Nuevo Usuario

### Usando Tinker:

```bash
php artisan tinker
```

```php
// Crear un nuevo empleado
\App\Models\User::create([
    'full_name' => 'Nuevo Empleado',
    'username' => 'nuevo_user',
    'password' => bcrypt('contraseña123'),
    'role' => 'employee'
]);

// Crear un nuevo admin
\App\Models\User::create([
    'full_name' => 'Nuevo Admin',
    'username' => 'nuevo_admin',
    'password' => bcrypt('contraseña123'),
    'role' => 'admin'
]);
```

### Usando la interfaz web (como admin):

1. Login como admin
2. Ir a "Manage Users"
3. Click en "Add User"
4. Llenar el formulario
5. El usuario se creará automáticamente como **employee**

---

## 📊 Estadísticas de Tareas por Usuario

Según el SQL original, hay tareas asignadas a:

- **John (ID: 7)**: Tiene múltiples tareas asignadas
- **Elias (ID: 2)**: Tiene múltiples tareas asignadas

---

## 🔒 Seguridad

### ⚠️ IMPORTANTE:

1. **Todas las contraseñas** están hasheadas con **bcrypt** en la base de datos
2. El sistema **NO almacena** contraseñas en texto plano
3. Las contraseñas actuales (`123`) son solo para desarrollo
4. **En producción**, cambia TODAS las contraseñas por unas seguras

### Mejores Prácticas:

✅ Usar contraseñas de al menos 8 caracteres
✅ Combinar mayúsculas, minúsculas, números y símbolos
✅ No reutilizar contraseñas
✅ Cambiar contraseñas periódicamente

---

## 📝 Nota sobre la Migración

El sistema Laravel ahora usa:
- ✅ Autenticación nativa de Laravel
- ✅ Middleware para proteger rutas
- ✅ Middleware para verificar roles (admin/employee)
- ✅ Hash automático de contraseñas con bcrypt
- ✅ Sesiones seguras

Todo funciona exactamente igual que el sistema original, pero con las ventajas de seguridad y estructura de Laravel.

---

**¡Sistema listo para usar!** 🚀

Accede a: **http://localhost:8000/login**



