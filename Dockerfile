FROM php:8.2-apache

# Install semua dependencies sekaligus
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql mbstring exif pcntl bcmath gd zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/* && \
    a2enmod rewrite headers

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files dulu (untuk leverage cache)
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy seluruh aplikasi
COPY . .

# Setup folders dan permissions sekaligus
RUN mkdir -p bootstrap/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/framework/cache/data \
    storage/logs && \
    chown -R www-data:www-data . && \
    chmod -R 775 storage bootstrap/cache

# Konfigurasi Apache untuk Fly.io
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/:80/:8080/' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's/${APACHE_LOG_DIR}\/access.log/\/dev\/stdout/' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's/${APACHE_LOG_DIR}\/error.log/\/dev\/stderr/' /etc/apache2/sites-available/000-default.conf

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Laravel optimization (optional, bisa di-comment kalau bikin masalah)
RUN php artisan config:cache || true && \
    php artisan route:cache || true

EXPOSE 8080

CMD ["apache2-foreground"]