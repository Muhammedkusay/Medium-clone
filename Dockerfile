# Stage 1: Build Composer dependencies
FROM composer:2.7 AS composer-builder

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction

# Stage 2: Build frontend assets
FROM node:20 AS node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources/ ./resources/
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build

# Stage 3: Production PHP container with Laravel
FROM php:8.2-fpm

# Install PHP extensions and system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libzip-dev libpng-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

WORKDIR /var/www

# Copy application files
COPY . .

# Copy built vendor & assets
COPY --from=composer-builder /app/vendor ./vendor
COPY --from=node-builder /app/public ./public

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Laravel artisan setup: (Optional – use in entrypoint or manually)
# RUN php artisan storage:link && php artisan migrate --seed

EXPOSE 9000
CMD ["php-fpm"]

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]