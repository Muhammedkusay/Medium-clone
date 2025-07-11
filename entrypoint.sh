#!/bin/bash
set -e

echo "Running Laravel setup tasks..."

# Run package discovery
php artisan package:discover

# Cache config and routes (optional)
php artisan config:cache
php artisan route:cache

# Run migrations and seed database
php artisan migrate:fresh --force

# Create storage symlink if not exists
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

echo "Laravel setup complete. Starting PHP-FPM."

exec "$@"
