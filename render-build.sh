# Render.com Build Script
# This file tells Render how to build your application

#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm ci --only=production

# Build assets
npm run build

# Clear application caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "Build completed successfully!"