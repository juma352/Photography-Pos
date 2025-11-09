# Render.com Build Script
# This file tells Render how to build your application

#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies (including dev dependencies for build)
npm ci

# Build assets
npm run build

# Remove dev dependencies after build
npm prune --production

# Clear application caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "Build completed successfully!"