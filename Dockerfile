FROM php:8.2-apache

# ===== 1. INSTALL DEPENDENSI SISTEM =====
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
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/:80/:8080/' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's/${APACHE_LOG_DIR}\/access.log/\/dev\/stdout/' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's/${APACHE_LOG_DIR}\/error.log/\/dev\/stderr/' /etc/apache2/sites-available/000-default.conf

# ===== 5. SET WORKING DIRECTORY =====
WORKDIR /var/www/html

# ===== 6. COPY SELURUH APLIKASI =====
COPY . .

# ===== 7. BUAT FOLDER CACHE LARAVEL DAN SET PERMISSION DULU =====
RUN mkdir -p bootstrap/cache storage/framework/{sessions,views,cache} && \
    chown -R www-data:www-data . && \
    chmod -R 775 storage bootstrap/cache

# ===== 8. INSTALL DEPENDENCIES COMPOSER =====
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ===== 9. LARAVEL COMMANDS (sekarang aman) =====
RUN if [ ! -f .env ]; then cp .env.example .env && php artisan key:generate --no-interaction; fi && \
    php artisan config:cache && \
    php artisan route:cache

# ===== 10. FIX APACHE DOCUMENT ROOT =====
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN mkdir -p storage/framework/views && \
    chown -R www-data:www-data storage/framework/views && \
    chmod -R 775 storage/framework/views

EXPOSE 8080
    
CMD ["apache2-foreground"]