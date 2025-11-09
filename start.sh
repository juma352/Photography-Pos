#!/bin/bash

echo "🚀 Starting Mawingu Photography Portfolio..."

# Clear Laravel caches
echo "⚙️ Clearing caches..."
php artisan config:clear
php artisan route:clear  
php artisan view:clear

# Generate application key if missing
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Start the application (skip database setup for now)
echo "✅ Starting PHP server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}