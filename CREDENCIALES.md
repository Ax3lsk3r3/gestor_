# 🔐 Credenciales de Acceso

## Usuarios de Prueba

Los siguientes usuarios se crean automáticamente cuando inicias un Codespace nuevo:

---

### 👨‍💼 Administrador

- **Usuario:** `admin`
- **Contraseña:** `123`
- **Rol:** Administrador

**Permisos:**
- ✅ Gestión completa de usuarios
- ✅ Crear, editar y eliminar tareas
- ✅ Asignar tareas a empleados
- ✅ Ver todas las tareas del sistema
- ✅ Acceso al dashboard administrativo

---

### 👤 Empleados

#### Empleado 1:
- **Usuario:** `juan`
- **Contraseña:** `123`
- **Rol:** Empleado

#### Empleado 2:
- **Usuario:** `maria`
- **Contraseña:** `123`
- **Rol:** Empleado

**Permisos:**
- ✅ Ver sus propias tareas asignadas
- ✅ Actualizar el estado de sus tareas
- ✅ Ver notificaciones
- ✅ Editar su perfil
- ❌ No pueden crear, editar o eliminar tareas
- ❌ No tienen acceso a la gestión de usuarios

---

## 🔄 Cómo Recrear los Usuarios

Si por alguna razón necesitas recrear los usuarios, ejecuta:

```bash
# Refrescar la base de datos (⚠️ Esto eliminará todos los datos)
php artisan migrate:fresh --seed
```

---

## ➕ Crear Usuarios Manualmente

Si quieres crear usuarios adicionales:

```bash
php artisan tinker
```

Luego:

```php
// Para un Admin
\App\Models\User::create([
    'full_name' => 'Tu Nombre',
    'username' => 'tunombre',
    'password' => bcrypt('tucontraseña'),
    'role' => 'admin'
]);

// Para un Empleado
\App\Models\User::create([
    'full_name' => 'Nombre Empleado',
    'username' => 'empleado',
    'password' => bcrypt('contraseña'),
    'role' => 'employee'
]);
```

---

## 🔒 Seguridad

**⚠️ IMPORTANTE:** Estas son credenciales de **desarrollo/prueba**.

**En producción:**
- ❌ NO uses contraseñas simples como `123`
- ✅ Usa contraseñas fuertes y únicas
- ✅ Considera implementar autenticación de dos factores
- ✅ Cambia todas las contraseñas predeterminadas
- ✅ Usa variables de entorno para credenciales sensibles

---

## 🧪 Probar las Credenciales

1. Inicia el servidor: `php artisan serve --host=0.0.0.0`
2. Abre la aplicación desde la pestaña PORTS (globo 🌐)
3. Ve a `/login`
4. Ingresa las credenciales de arriba
5. ¡Explora el sistema!

---

**¿Problemas para iniciar sesión?** Verifica que los seeders se hayan ejecutado:

```bash
php artisan db:seed
```

