#!/bin/sh
set -e

echo "==> Criando diretórios de storage..."
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache/data
mkdir -p storage/logs
chmod -R 775 storage bootstrap/cache

echo "==> Aguardando banco de dados ficar pronto..."
until php artisan migrate --force 2>&1; do
  echo "    DB ainda não pronto, tentando novamente em 3s..."
  sleep 3
done

echo "==> Limpando cache de config e views..."
php artisan config:clear
php artisan view:clear

echo "==> Iniciando servidor PHP na porta ${PORT:-8080}..."
exec php -S 0.0.0.0:${PORT:-8080} -t public public/router.php
