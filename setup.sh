#!/usr/bin/env bash
# Copy .env
if [ ! -f .env ]; then
    cp .env.example .env
fi

composer install
# Clear config cache
php artisan config:clear
# Clear route cache
php artisan route:clear
# Generate APP_KEY
php artisan key:generate --force
# Migrate Database
php artisan migrate:fresh
# Cache Config
php artisan config:cache
# Cache Routes
php artisan route:cache
# Seed Database
php artisan db:seed

# Install project npm dependencies and Vite
npm install  # Install dependencies from package.json
npm install vite --save-dev  # Ensure Vite is installed

# Start the fpm module
php-fpm