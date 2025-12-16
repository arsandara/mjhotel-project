FROM php:8.2-apache

# ===== 1. INSTALL SEMUA DEPENDENSI SEKALIGUS =====
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    libpq-dev && \
    docker-php-ext-install \
    pdo pdo_pgsql pgsql \
    pdo_mysql mbstring exif pcntl bcmath gd zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# ===== 2. INSTALL COMPOSER =====
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ===== 3. ENABLE APACHE MODULES =====
RUN a2enmod rewrite headers

# ===== 4. KONFIGURASI APACHE UNTUK FLY.IO =====
# Fly.io menggunakan port 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf
RUN sed -i 's/:80/:8080/' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/${APACHE_LOG_DIR}\/access.log/\/dev\/stdout/' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/${APACHE_LOG_DIR}\/error.log/\/dev\/stderr/' /etc/apache2/sites-available/000-default.conf

# ===== 5. SET WORKING DIRECTORY =====
WORKDIR /var/www/html

# ===== 6. COPY COMPOSER FILES =====
COPY composer.json composer.lock* ./

# ===== 7. INSTALL DEPENDENCIES (lebih efisien) =====
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ===== 8. COPY SELURUH APLIKASI =====
COPY . .

# ===== 9. SETUP LARAVEL FOLDERS DAN PERMISSIONS =====
RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    bootstrap/cache

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache \
    && chmod -R 777 storage/framework/cache

# ===== 10. GENERATE KEY DAN PACKAGE DISCOVERY =====
# Generate APP_KEY jika belum ada (untuk build time)
RUN if [ ! -f .env ]; then \
        cp .env.example .env && \
        php artisan key:generate --no-interaction; \
    fi

RUN php artisan package:discover --no-interaction \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# ===== 11. FIX APACHE DOCUMENT ROOT =====
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 8080
CMD ["apache2-foreground"]