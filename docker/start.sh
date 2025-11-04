#!/bin/bash

# Gerar key se não existir
if [ -z "$(grep 'APP_KEY=base64' .env)" ]; then
    php artisan key:generate --force
fi

# Executar migrações se variável estiver definida
if [ "$RUN_MIGRATIONS" = "true" ]; then
    php artisan migrate --force
fi

# Otimizar aplicação
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar serviços
echo "Starting PHP-FPM..."
php-fpm -D

echo "Starting Nginx..."
nginx -g 'daemon off;'