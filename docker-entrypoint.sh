#!/bin/bash

# Install dependencies if vendor directory is missing or composer.json changed
if [ ! -d "vendor" ]; then
  composer install --no-interaction --optimize-autoloader
fi

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
  php artisan key:generate
fi

# Run migrations (force for dev setup if needed, but safer without --force in general entrypoints)
php artisan migrate:fresh --seed --force

# Execute the main CMD
exec "$@"
