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

# roda laravel: aguarda o postgres, roda migrations e inicia o servidor
CMD ["sh", "-c", "echo 'Aguardando banco de dados...' && until php artisan migrate --force 2>&1; do echo 'DB ainda nao pronto, tentando novamente em 3s...'; sleep 3; done && php artisan config:clear && php -S 0.0.0.0:${PORT:-8080} -t public public/router.php"]