# Stage 1: Install composer dependencies without scripts
FROM composer:2.7 AS composer-builder

WORKDIR /app

COPY composer.json composer.lock ./
COPY .env.example .env
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

# Stage 2: Build frontend assets
FROM node:20 AS node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources/ ./resources/
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build

# Stage 3: Production PHP container
FROM php:8.2-fpm

# Install PHP extensions and system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libzip-dev libpng-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

WORKDIR /var/www

# Copy application code
COPY . .

# Copy composer vendor & node-built public assets
COPY --from=composer-builder /app/vendor ./vendor
COPY --from=node-builder /app/public ./public

# Copy entrypoint and give execute permissions
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Permissions for storage and cache
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]

CMD ["php-fpm"]