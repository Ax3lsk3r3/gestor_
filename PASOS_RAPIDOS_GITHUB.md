# 🚀 Pasos Rápidos para Subir a GitHub

## Paso 1: Crear Repositorio en GitHub

1. Ve a https://github.com/new
2. Nombre del repositorio: `gestortareas`
3. Descripción: "Sistema de gestión de tareas con Laravel 12"
4. Elige Public o Private
5. ⚠️ **NO marques ninguna opción** (Add README, .gitignore, license)
6. Clic en "Create repository"

## Paso 2: Ejecutar Estos Comandos

Abre PowerShell en la carpeta de tu proyecto y ejecuta:

```powershell
# Verificar estado actual
git status

# Agregar el remote de GitHub (ya está configurado como gestortareas)
git remote add origin https://github.com/Ax3lsk3r3/gestortareas.git

# Verificar que se agregó correctamente
git remote -v

# Subir el código a GitHub
git push -u origin main
```

**Tu configuración actual:**
```powershell
# El remote ya está configurado como:
# https://github.com/Ax3lsk3r3/gestortareas.git
git push -u origin main
```

## Paso 3: Verificar en GitHub

1. Ve a tu repositorio en GitHub
2. Deberías ver todos los archivos
3. El README.md debería mostrarse en la página principal

---

## ☁️ Abrir en Codespaces

### Opción 1: Desde GitHub

1. Ve a tu repositorio
2. Clic en el botón verde **"Code"**
3. Pestaña **"Codespaces"**
4. Clic en **"Create codespace on main"**
5. Espera 2-5 minutos mientras se configura
6. Una vez listo, en la terminal ejecuta:
   ```bash
   php artisan serve
   ```
7. Clic en "Open in Browser" cuando aparezca la notificación

### Opción 2: URL Directo

Tu enlace directo a Codespaces:

```
https://codespaces.new/Ax3lsk3r3/gestortareas
```

---

## ✅ ¡Listo!

Tu proyecto ahora está en GitHub y cualquiera puede abrirlo en Codespaces con un solo clic.

### Próximos pasos recomendados:

1. **Agregar colaboradores**: Settings → Collaborators → Add people
2. **Configurar protección de rama**: Settings → Branches → Add rule
3. **Agregar secrets**: Settings → Secrets → New repository secret (para producción)

---

## 🆘 ¿Problemas?

### Error: "remote origin already exists"

```powershell
git remote remove origin
git remote add origin https://github.com/tu-usuario/gestor-de-tareas.git
```

### Error: "failed to push some refs"

```powershell
git pull origin main --rebase
git push -u origin main
```

### Error de autenticación

GitHub ya no acepta contraseñas. Necesitas:

1. Crear un **Personal Access Token**:
   - Ve a GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
   - "Generate new token (classic)"
   - Selecciona: `repo` (todos los permisos de repositorio)
   - Copia el token

2. Al hacer push, usa el token como contraseña:
   ```
   Username: tu-usuario
   Password: [pega tu token aquí]
   ```

**O mejor aún, usa GitHub CLI:**

```powershell
# Instalar GitHub CLI
winget install GitHub.cli

# Autenticarse
gh auth login

# Crear repositorio y subir código
gh repo create gestor-de-tareas --public --source=. --remote=origin --push
```

---

## 📋 Checklist

- [ ] Repositorio creado en GitHub
- [ ] Remote agregado (`git remote -v` para verificar)
- [ ] Código subido (`git push -u origin main`)
- [ ] README.md se ve correctamente en GitHub
- [ ] Archivo `.env.example` está en el repositorio
- [ ] Archivo `.env` NO está en el repositorio (verificar en GitHub)
- [ ] Codespace creado y funcionando
- [ ] Servidor Laravel corriendo en Codespace

