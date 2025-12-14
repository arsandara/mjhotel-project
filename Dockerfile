FROM php:8.2-apache

# 1. Install dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 2. Enable Apache mod_rewrite
RUN a2enmod rewrite

# 3. Konfigurasi Apache untuk port 8080
RUN echo "Listen 8080" > /etc/apache2/ports.conf

# Buat virtual host untuk port 8080
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Aktifkan site (otomatis nonaktifkan yang lama)
RUN a2ensite 000-default.conf

# 4. Set working directory
WORKDIR /var/www/html

# 5. Copy aplikasi
COPY . .

# 6. Set permissions (sesuaikan dengan Laravel)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# 7. Expose port 8080
EXPOSE 8080

# 8. Start Apache
CMD ["apache2-foreground"]