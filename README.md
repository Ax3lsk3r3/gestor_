# Gestor de Tareas

[![Abrir en GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/Ax3lsk3r3/gestortareas)

Sistema de gestión de tareas desarrollado con Laravel 12 y Tailwind CSS 4.

## 🚀 Características

- **Autenticación de usuarios** con roles (Admin y Empleado)
- **Gestión completa de tareas** (CRUD)
- **Asignación de tareas** a empleados
- **Sistema de notificaciones**
- **Dashboard personalizado** según rol
- **Filtros y búsqueda** de tareas
- **Interfaz moderna** con Tailwind CSS 4

## 📋 Requisitos

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL o SQLite

## 🔧 Instalación Local

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd gestor
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Configurar el entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar la base de datos

Edita el archivo `.env` con tus credenciales de base de datos:

**Para SQLite (por defecto):**
```env
DB_CONNECTION=sqlite
```

**Para MySQL:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Ejecutar migraciones

```bash
php artisan migrate
```

### 6. Compilar assets

```bash
npm run build
```

### 7. Iniciar el servidor

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## 👥 Usuarios de Prueba

Consulta el archivo `USUARIOS_Y_CREDENCIALES.md` para obtener las credenciales de acceso.

## 🐳 Desarrollo con Laravel Sail (Opcional)

Si prefieres usar Docker:

```bash
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

## 📚 Documentación Adicional

- [INSTALACION.md](INSTALACION.md) - Guía detallada de instalación
- [COMANDOS_UTILES.md](COMANDOS_UTILES.md) - Comandos útiles de Laravel
- [NUEVAS_FUNCIONALIDADES.md](NUEVAS_FUNCIONALIDADES.md) - Funcionalidades del sistema

## 🤝 Contribuir

Las contribuciones son bienvenidas. Por favor, abre un issue primero para discutir los cambios que te gustaría realizar.

## 📄 Licencia

Este proyecto es de código abierto bajo la licencia MIT.
