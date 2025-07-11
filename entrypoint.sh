#!/bin/bash

php artisan config:cache
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link

exec "$@"
