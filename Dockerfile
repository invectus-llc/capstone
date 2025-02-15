# Use the official PHP 8.2 image with FPM
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    libpng-dev \
    libonig-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory and copy files
WORKDIR /var/www
COPY . .

# Change ownership of storage and cache to www-data
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy and change execution mode of the setup.sh file
COPY setup.sh /usr/local/bin/setup.sh
RUN chmod +x /usr/local/bin/setup.sh

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Run the basic setup
CMD ["setup.sh"]