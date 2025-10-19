# 📦 Guía para Subir a GitHub y Usar Codespaces

Esta guía te ayudará a subir tu proyecto a GitHub y configurarlo para usar GitHub Codespaces.

## 🚀 Pasos para Subir a GitHub

### 1. Crear un Repositorio en GitHub

1. Ve a [GitHub](https://github.com)
2. Haz clic en el botón **"+"** en la esquina superior derecha
3. Selecciona **"New repository"**
4. Configura tu repositorio:
   - **Repository name**: `gestor-de-tareas` (o el nombre que prefieras)
   - **Description**: "Sistema de gestión de tareas con Laravel 12 y Tailwind CSS 4"
   - **Visibility**: Elige "Public" o "Private"
   - ⚠️ **NO marques** "Add a README file" (ya tienes uno)
   - ⚠️ **NO agregues** .gitignore ni license (ya los tienes)
5. Haz clic en **"Create repository"**

### 2. Conectar tu Proyecto Local con GitHub

GitHub te mostrará una página con instrucciones. Como ya tienes un repositorio existente, usa estos comandos:

```bash
# Agregar el remote de GitHub (reemplaza <tu-usuario> con tu nombre de usuario)
git remote add origin https://github.com/<tu-usuario>/gestor-de-tareas.git

# Renombrar la rama actual a main (si es necesario)
git branch -M main

# Subir tu código a GitHub
git push -u origin main
```

**Ejemplo completo:**
```bash
git remote add origin https://github.com/juan/gestor-de-tareas.git
git branch -M main
git push -u origin main
```

### 3. Verificar que se Subió Correctamente

1. Ve a tu repositorio en GitHub
2. Deberías ver todos tus archivos
3. Verifica que el README.md se muestre correctamente

---

## ☁️ Usar GitHub Codespaces

### ¿Qué es GitHub Codespaces?

GitHub Codespaces te permite desarrollar directamente desde tu navegador con un entorno completo de VS Code en la nube. ¡No necesitas instalar nada localmente!

### 1. Crear un Codespace

**Opción A: Desde GitHub.com**

1. Ve a tu repositorio en GitHub
2. Haz clic en el botón verde **"Code"**
3. Selecciona la pestaña **"Codespaces"**
4. Haz clic en **"Create codespace on main"**

**Opción B: Con el Botón Directo**

Agrega este badge a tu README.md:

```markdown
[![Abrir en GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/<tu-usuario>/gestor-de-tareas)
```

### 2. Espera la Configuración Automática

GitHub Codespaces ejecutará automáticamente el script de configuración (`.devcontainer/setup.sh`) que:

- ✅ Instala todas las dependencias de PHP con Composer
- ✅ Instala todas las dependencias de Node.js con npm
- ✅ Crea el archivo `.env` desde `.env.example`
- ✅ Genera la clave de aplicación de Laravel
- ✅ Crea la base de datos SQLite
- ✅ Ejecuta las migraciones
- ✅ Compila los assets con Vite

Este proceso puede tardar **2-5 minutos** la primera vez.

### 3. Iniciar el Servidor

Una vez que termine la configuración, abre una terminal en Codespaces y ejecuta:

```bash
php artisan serve
```

GitHub Codespaces detectará automáticamente el puerto 8000 y te preguntará si quieres abrirlo. Haz clic en **"Open in Browser"**.

### 4. (Opcional) Desarrollo con Hot Reload

Si quieres que Vite compile automáticamente tus cambios de CSS/JS, abre **otra terminal** y ejecuta:

```bash
npm run dev
```

---

## 🎯 Características Configuradas para Codespaces

Tu proyecto incluye:

### Extensiones de VS Code Preinstaladas

- **PHP Intelephense**: Autocompletado inteligente de PHP
- **Laravel Extra Intellisense**: Autocompletado de rutas, vistas, etc.
- **Laravel Blade**: Sintaxis highlighting para Blade
- **Tailwind CSS IntelliSense**: Autocompletado de clases Tailwind
- **ESLint**: Linter para JavaScript

### Configuración Automática

- ✅ PHP 8.2
- ✅ Node.js 20
- ✅ Composer
- ✅ GitHub CLI
- ✅ Puertos 8000 y 5173 expuestos automáticamente

### Base de Datos

Por defecto usa **SQLite**, así que no necesitas configurar MySQL en Codespaces. Todo funciona out-of-the-box.

---

## 🔒 Buenas Prácticas de Seguridad

### ⚠️ Archivos que NUNCA debes subir a GitHub:

- ❌ `.env` (contiene información sensible)
- ❌ `/vendor` (se instala con Composer)
- ❌ `/node_modules` (se instala con npm)
- ❌ `database/*.sqlite` (base de datos local)

Todos estos ya están en tu `.gitignore`, así que no te preocupes.

### ✅ Archivo `.env.example`

Este archivo **SÍ** se sube a GitHub porque:
- No contiene información sensible
- Sirve como plantilla para otros desarrolladores
- Codespaces lo usa para crear el `.env` automáticamente

---

## 🛠️ Comandos Útiles en Codespaces

```bash
# Ver logs de Laravel
php artisan pail

# Limpiar caché
php artisan cache:clear
php artisan config:clear

# Ver rutas disponibles
php artisan route:list

# Ejecutar migraciones
php artisan migrate

# Crear un nuevo modelo
php artisan make:model NombreModelo -m

# Ejecutar tests
php artisan test
```

---

## 📊 Costos de Codespaces

GitHub ofrece:

- ✅ **Gratis**: 120 horas/mes para cuentas gratuitas
- ✅ **Gratis**: 180 horas/mes para GitHub Pro
- ⚠️ Los Codespaces se pausan automáticamente después de 30 minutos de inactividad

---

## 🆘 Solución de Problemas

### El Codespace no inicia

1. Verifica que el archivo `.devcontainer/setup.sh` tenga permisos de ejecución
2. Revisa los logs de creación del Codespace

### Error: "APP_KEY not set"

Ejecuta manualmente:
```bash
php artisan key:generate
```

### Error de base de datos

Verifica que el archivo `database/database.sqlite` exista:
```bash
touch database/database.sqlite
php artisan migrate
```

### El servidor no responde

Verifica que el puerto esté correctamente expuesto:
```bash
# En Codespaces, ve a la pestaña "PORTS"
# Asegúrate de que el puerto 8000 esté en la lista
```

---

## 📚 Recursos Adicionales

- [Documentación de GitHub Codespaces](https://docs.github.com/es/codespaces)
- [Documentación de Laravel](https://laravel.com/docs/11.x)
- [Documentación de Tailwind CSS](https://tailwindcss.com/docs)

---

## ✨ Siguiente Paso

Una vez que hayas subido tu proyecto a GitHub:

1. Comparte el enlace de tu repositorio con otros desarrolladores
2. Ellos podrán abrir un Codespace con un solo clic
3. El entorno estará listo para desarrollar en minutos

¡Disfruta de tu proyecto en la nube! 🚀

