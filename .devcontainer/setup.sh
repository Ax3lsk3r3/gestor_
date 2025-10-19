#!/bin/bash

echo "🚀 Configurando el entorno de desarrollo..."

# Instalar dependencias de Composer
echo "📦 Instalando dependencias de PHP..."
composer install --no-interaction

# Crear archivo de entorno
echo "📝 Creando archivo .env..."
cat > .env << 'ENVEOF'
APP_NAME=GestorDeTareas
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000

APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=es_ES

APP_MAINTENANCE_DRIVER=file

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME=GestorDeTareas

VITE_APP_NAME=GestorDeTareas
ENVEOF

# Generar clave de aplicación
echo "🔑 Generando clave de aplicación..."
php artisan key:generate --no-interaction

# Crear base de datos SQLite
echo "💾 Creando base de datos SQLite..."
touch database/database.sqlite
chmod 664 database/database.sqlite

# Ejecutar migraciones
echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force

# Instalar dependencias de Node.js
echo "📦 Instalando dependencias de Node.js..."
npm install

# Compilar assets
echo "🎨 Compilando assets..."
npm run build

# Configurar permisos
echo "🔐 Configurando permisos..."
chmod -R 775 storage bootstrap/cache

# Limpiar caché
echo "🧹 Limpiando caché..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo ""
echo "✅ ¡Entorno configurado correctamente!"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📌 PASOS PARA INICIAR LA APLICACIÓN:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "1️⃣  Ejecuta el servidor:"
echo "    php artisan serve --host=0.0.0.0"
echo ""
echo "2️⃣  Ve a la pestaña PORTS (parte inferior)"
echo ""
echo "3️⃣  Busca el puerto 8000"
echo ""
echo "4️⃣  Haz clic en el ícono del GLOBO 🌐"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

