FROM php:8.2-fpm

FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Install ekstensi PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project
COPY . .

# Jalankan Laravel di container
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
