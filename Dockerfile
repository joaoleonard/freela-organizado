FROM php:8.2-cli

WORKDIR /app

# instala extensões necessárias
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# instala composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copia projeto
COPY . .

# instala dependências
RUN composer install --no-dev --optimize-autoloader

# garante permissões de escrita no storage e cache
RUN chmod -R 775 storage bootstrap/cache

# porta
EXPOSE 8080

# roda laravel: cria o banco SQLite, roda migrations e inicia o servidor
CMD ["sh", "-c", "touch database/database.sqlite && php artisan migrate --force || true && php artisan config:clear || true && php -S 0.0.0.0:${PORT:-8080} -t public public/router.php"]