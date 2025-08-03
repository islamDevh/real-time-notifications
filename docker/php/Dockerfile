FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev && \
    docker-php-ext-install pdo_mysql zip gd

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www

# 🔧 Set Apache DocumentRoot to /var/www/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/public|g' /etc/apache2/sites-available/000-default.conf

# Copy default Apache config
COPY ./docker/php/docker-entrypoint.sh /var/www/docker/php/docker-entrypoint.sh
RUN chmod +x /var/www/docker/php/docker-entrypoint.sh

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
