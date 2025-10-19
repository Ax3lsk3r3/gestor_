#!/bin/bash

echo "🔧 Actualizando URL de la aplicación..."

# Detectar la URL de Codespaces
if [ -n "$CODESPACE_NAME" ]; then
    APP_URL="https://${CODESPACE_NAME}-8000.app.github.dev"
    echo "🌐 URL detectada: $APP_URL"
    
    # Actualizar en .env
    sed -i "s|APP_URL=.*|APP_URL=${APP_URL}|g" .env
    
    # Limpiar configuración
    php artisan config:clear
    php artisan cache:clear
    
    echo "✅ URL actualizada correctamente"
    echo ""
    echo "Ahora accede a:"
    echo "  $APP_URL"
    echo ""
else
    echo "❌ No estás en Codespaces"
fi

