#!/bin/bash

# Script para arreglar el archivo .env en Codespaces

echo "🔧 Arreglando archivo .env..."

# Crear un archivo .env correcto
cat > .env << 'EOF'
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
EOF

# Generar clave de aplicación
echo "🔑 Generando clave de aplicación..."
php artisan key:generate

# Crear base de datos si no existe
if [ ! -f database/database.sqlite ]; then
    echo "💾 Creando base de datos SQLite..."
    touch database/database.sqlite
fi

# Ejecutar migraciones
echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force

echo "✅ ¡Archivo .env corregido!"
echo ""
echo "Ahora ejecuta:"
echo "  php artisan serve"

