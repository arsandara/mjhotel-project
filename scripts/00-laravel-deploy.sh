#!/usr/bin/env bash

echo "Changing to app directory..."
cd /var/www/html

echo "Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

echo "Generating application key (if needed)..."
php artisan key:generate --force

echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running database migrations..."
php artisan migrate --force --no-interaction