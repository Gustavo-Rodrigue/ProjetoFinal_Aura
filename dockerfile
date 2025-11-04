FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nginx

# Limpar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões do PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Nginx
RUN echo 'server {\
    listen 80;\
    server_name _;\
    root /var/www/public;\
    index index.php index.html;\
    location / {\
        try_files \$uri \$uri/ /index.php?\$query_string;\
    }\
    location ~ \.php\$ {\
        fastcgi_pass 127.0.0.1:9000;\
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;\
        include fastcgi_params;\
    }\
}' > /etc/nginx/sites-available/default

RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

# Criar diretório da aplicação
WORKDIR /var/www

# Copiar aplicação
COPY . /var/www/

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# CORRIGIR PERMISSÕES - Esta é a parte importante!
RUN mkdir -p /var/www/storage/logs /var/www/storage/framework/sessions /var/www/storage/framework/views /var/www/storage/framework/cache

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 777 /var/www/storage/logs/

# Criar arquivo de log com permissões corretas
RUN touch /var/www/storage/logs/laravel.log
RUN chmod 666 /var/www/storage/logs/laravel.log
RUN chown www-data:www-data /var/www/storage/logs/laravel.log

# Script de inicialização
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Criar diretórios de storage se não existirem\n\
mkdir -p storage/framework/sessions\n\
mkdir -p storage/framework/views\n\
mkdir -p storage/framework/cache\n\
\n\
# Corrigir permissões\n\
chmod -R 775 storage bootstrap/cache\n\
chmod -R 777 storage/logs/\n\
\n\
# Gerar key se necessário\n\
if [ ! -f ".env" ]; then\n\
    cp .env.example .env\n\
fi\n\
\n\
php artisan key:generate --force\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
\n\
# Iniciar serviços\n\
php-fpm -D\n\
nginx -g "daemon off;"' > /start.sh

RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]