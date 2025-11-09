#!/bin/bash
# Build script for Railway deployment

echo "🔧 Building Mawingu Photography Portfolio for Railway..."

# Check PHP version
php -v

# Install PHP dependencies without platform requirements check
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Install Node dependencies (including dev for build tools)
echo "📦 Installing Node dependencies..."
npm ci

# Build assets
echo "🎨 Building frontend assets..."
npm run build

# Clean up node_modules after build (optional for smaller deployment)
echo "🧹 Cleaning up dev dependencies..."
npm prune --production

# Clear Laravel caches (but don't cache yet - Railway will do this)
echo "⚙️ Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "✅ Build complete! Ready for Railway deployment."