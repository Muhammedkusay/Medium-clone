# Stage 1: Composer dependencies (build stage)
FROM composer:2.7 AS composer-builder

WORKDIR /app

COPY composer.json composer.lock ./
COPY .env.example .env
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

# Stage 2: Node frontend build
FROM node:20 AS node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources/ ./resources/
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build

# Stage 3: PHP + Nginx production image
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx git curl unzip zip libpq-dev libzip-dev libpng-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Copy composer vendor and built frontend assets
WORKDIR /var/www

COPY . .

COPY --from=composer-builder /app/vendor ./vendor
COPY --from=node-builder /app/public ./public

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Copy custom Nginx config
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Remove default nginx website
RUN rm /etc/nginx/sites-enabled/default || true

# Expose ports
EXPOSE 80

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

# Start both PHP-FPM and Nginx using a small script
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
