#!/bin/sh

# wait for MySQL to be ready
echo "⏳ Waiting for MySQL..."
sleep 15

# install Composer 
composer install

# if the .env file does not exist, copy the example
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Laravel commands
php artisan key:generate
php artisan migrate --force

# start Apache (the web server)
apache2-foreground
