# 🚀 Instrucciones para Abrir el Proyecto en Codespaces

## Paso 1: Eliminar el Codespace Actual

1. Ve a tu repositorio: https://github.com/Ax3lsk3r3/gestortareas
2. Haz clic en **Code** → **Codespaces**
3. Haz clic en los **tres puntos (⋮)** del Codespace actual
4. Selecciona **"Delete"**
5. Confirma la eliminación

---

## Paso 2: Crear un Nuevo Codespace

1. En tu repositorio, haz clic en el botón verde **"Code"**
2. Pestaña **"Codespaces"**
3. Haz clic en **"Create codespace on main"**
4. **Espera 3-5 minutos** mientras se configura automáticamente

Verás que se instalan:
- ✅ Dependencias de PHP (Composer)
- ✅ Dependencias de Node.js (npm)
- ✅ Base de datos SQLite
- ✅ Migraciones ejecutadas
- ✅ Assets compilados

---

## Paso 3: Iniciar el Servidor

Una vez que termine la configuración, en la terminal ejecuta:

```bash
php artisan serve --host=0.0.0.0
```

Deberías ver:
```
INFO  Server running on [http://0.0.0.0:8000].
```

---

## Paso 4: Abrir la Aplicación

### 🌐 OPCIÓN 1: Usando la Pestaña PORTS (RECOMENDADO)

1. En la parte **inferior** de tu Codespace, busca la pestaña **"PORTS"**
   - Si no la ves, presiona: `Ctrl+Shift+P` → escribe "Ports" → "Ports: Focus on Ports View"

2. Verás una lista de puertos. Busca el **8000**

3. En la misma fila del puerto 8000, verás un **ícono de globo 🌐**

4. **HAZ CLIC EN EL GLOBO 🌐**

5. Se abrirá una nueva pestaña con tu aplicación

### 🔗 OPCIÓN 2: Usando la Notificación

Cuando inicies el servidor, puede aparecer una notificación que dice:

```
"Your application running on port 8000 is available"
[Open in Browser]
```

Haz clic en **"Open in Browser"**.

### 📋 OPCIÓN 3: Copiar la URL desde PORTS

1. Ve a la pestaña **"PORTS"**
2. En el puerto **8000**, busca la columna **"Forwarded Address"**
3. **Copia** la URL completa (algo como: `https://algo-algo-8000.app.github.dev`)
4. **Pégala** en tu navegador
5. **NO agregues nada al final** (ni `:8000` ni nada)

---

## ⚠️ MUY IMPORTANTE

### ❌ NO HAGAS ESTO:
```
https://algo-algo-8000.app.github.dev:8000
                                    ^^^^^^ NO AGREGUES ESTO
```

### ✅ HAZ ESTO:
```
https://algo-algo-8000.app.github.dev
```

**El puerto ya está incluido en el nombre del dominio (`-8000`).**

---

## 🔐 Credenciales de Acceso

Por defecto, si tienes seeders, podrás acceder con:

**Admin:**
- Usuario: `admin`
- Contraseña: `123`

**Empleado:**
- Usuario: `john`
- Contraseña: `123`

*(Verifica el archivo `USUARIOS_Y_CREDENCIALES.md` para más información)*

---

## 🆘 Solución de Problemas

### El puerto no aparece en PORTS
```bash
# Reinicia el servidor
php artisan serve --host=0.0.0.0 --port=8000
```

### Error: "The environment file is invalid"
```bash
# Ejecuta el script de reparación
bash fix-env.sh
```

### Error: "APP_KEY not set"
```bash
php artisan key:generate
```

### Error de base de datos
```bash
touch database/database.sqlite
php artisan migrate --force
```

### La página no carga
1. Verifica que el servidor esté corriendo (deberías ver `Server running...`)
2. Asegúrate de NO agregar `:8000` al final de la URL
3. Haz clic directamente en el globo 🌐 de la pestaña PORTS
4. Prueba en una ventana de incógnito
5. Verifica que el puerto sea **Public** (click derecho en puerto 8000 → Port Visibility → Public)

---

## ✅ Todo Funcionando

Una vez que veas la página de login:

1. Inicia sesión con las credenciales
2. Explora el sistema de tareas
3. ¡Empieza a desarrollar!

---

## 💡 Tips

- El Codespace se **pausa automáticamente** después de 30 minutos de inactividad
- Tienes **120 horas gratis** al mes
- Puedes tener **múltiples Codespaces** para diferentes ramas
- Para detener el servidor: `Ctrl+C`
- Para cerrar el Codespace: Click en "Codespaces" (abajo izquierda) → "Stop Current Codespace"

---

## 🎯 Comandos Útiles

```bash
# Ver rutas disponibles
php artisan route:list

# Limpiar caché
php artisan cache:clear
php artisan config:clear

# Ejecutar migraciones
php artisan migrate

# Ver logs en tiempo real
php artisan pail

# Desarrollo con Vite (en otra terminal)
npm run dev
```

---

¡Disfruta desarrollando en la nube! ☁️🚀

