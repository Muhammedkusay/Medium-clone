# Use official PHP image with required extensions
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    libsqlite3-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_sqlite zip mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents (including database.sqlite)
COPY . .

# ✅ FIX: Now fix permissions AFTER copying files
RUN chown -R www-data:www-data /var/www/html/database \
    && chmod -R 775 /var/www/html/database

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install && npm run build

# Run Laravel specific commands
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Run migrations and link storage
RUN php artisan migrate --force
RUN php artisan storage:link

# Set permissions (adjust user/group if necessary)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
