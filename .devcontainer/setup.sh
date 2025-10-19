#!/bin/bash

echo "🚀 Configurando el entorno de desarrollo..."

# Instalar dependencias de Composer
echo "📦 Instalando dependencias de PHP..."
composer install --no-interaction

# Copiar archivo de entorno
if [ ! -f .env ]; then
    echo "📝 Creando archivo .env..."
    cp .env.example .env
fi

# Generar clave de aplicación
echo "🔑 Generando clave de aplicación..."
php artisan key:generate --no-interaction

# Crear base de datos SQLite si no existe
if [ ! -f database/database.sqlite ]; then
    echo "💾 Creando base de datos SQLite..."
    touch database/database.sqlite
fi

# Ejecutar migraciones
echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force

# Instalar dependencias de Node.js
echo "📦 Instalando dependencias de Node.js..."
npm install

# Compilar assets
echo "🎨 Compilando assets..."
npm run build

# Limpiar caché
echo "🧹 Limpiando caché..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "✅ ¡Entorno configurado correctamente!"
echo ""
echo "Para iniciar el servidor, ejecuta:"
echo "  php artisan serve"
echo ""
echo "Para desarrollo con Vite, ejecuta en otra terminal:"
echo "  npm run dev"

