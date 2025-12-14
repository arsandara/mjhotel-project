FROM php:8.2-apache

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Enable Apache mod_rewrite
RUN a2enmod rewrite

# 4. Konfigurasi Apache untuk port 8080
RUN echo "Listen 8080" > /etc/apache2/ports.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy HANYA composer.json
COPY composer.json ./

# 7. Install dependencies (generate lock otomatis jika tidak ada)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# 8. Copy seluruh aplikasi
COPY . .

# ===== PERBAIKAN UTAMA DI SINI =====
# 9. BUAT FOLDER YANG DIBUTUHKAN DAN ATUR PERMISSION
RUN mkdir -p bootstrap/cache storage/framework/sessions storage/framework/views storage/framework/cache
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 storage bootstrap/cache

# 10. JALANKAN PACKAGE DISCOVERY SAAT BUILD (KUNCI UTAMA!)
RUN php artisan package:discover --no-interaction
# ===================================

EXPOSE 8080
CMD ["apache2-foreground"]