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

# porta
EXPOSE 8080

# roda laravel
CMD php -S 0.0.0.0:$PORT -t public