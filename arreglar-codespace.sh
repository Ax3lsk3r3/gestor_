#!/bin/bash

echo "🔧 Arreglando configuración de Codespaces..."
echo ""

# Detectar nombre del Codespace
if [ -z "$CODESPACE_NAME" ]; then
    echo "❌ Error: No estás en un Codespace"
    exit 1
fi

echo "📍 Codespace detectado: $CODESPACE_NAME"
echo ""

# Configurar APP_URL correctamente
APP_URL="https://${CODESPACE_NAME}-8000.app.github.dev"
echo "🌐 Configurando APP_URL: $APP_URL"
sed -i "s|APP_URL=.*|APP_URL=${APP_URL}|g" .env

# Configurar ASSET_URL
echo "🎨 Configurando ASSET_URL: $APP_URL"
if grep -q "ASSET_URL=" .env; then
    sed -i "s|ASSET_URL=.*|ASSET_URL=${APP_URL}|g" .env
else
    echo "ASSET_URL=${APP_URL}" >> .env
fi

# Limpiar toda la caché
echo "🧹 Limpiando caché..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Mostrar configuración actual
echo ""
echo "✅ Configuración actualizada:"
echo ""
grep "APP_URL=" .env
grep "ASSET_URL=" .env
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🚀 AHORA SIGUE ESTOS PASOS:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "1️⃣  Si el servidor está corriendo, detenlo (Ctrl+C)"
echo ""
echo "2️⃣  Inicia el servidor:"
echo "    php artisan serve --host=0.0.0.0"
echo ""
echo "3️⃣  Abre en VENTANA INCÓGNITO del navegador"
echo ""
echo "4️⃣  Haz clic en el GLOBO 🌐 de la pestaña PORTS"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

