#!/bin/bash
# Build script for Railway deployment

echo "🔧 Building Mawingu Photography Portfolio for Railway..."

# Check PHP version
php -v

# Install PHP dependencies without platform requirements check
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Install Node dependencies  
echo "📦 Installing Node dependencies..."
npm ci --only=production

# Build assets
echo "🎨 Building frontend assets..."
npm run build

# Clear Laravel caches (but don't cache yet - Railway will do this)
echo "⚙️ Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "✅ Build complete! Ready for Railway deployment."