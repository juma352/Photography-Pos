#!/bin/bash
# Build script for production deployment

echo "🔧 Building Mawingu Photography Portfolio..."

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# Install Node dependencies  
echo "📦 Installing Node dependencies..."
npm ci

# Build assets
echo "🎨 Building frontend assets..."
npm run build

# Clear and cache Laravel configurations
echo "⚙️ Optimizing Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Generate optimized files
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build complete! Ready for deployment."