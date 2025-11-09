#!/bin/bash

echo "🚀 Starting Mawingu Photography Portfolio..."

# Wait for database to be ready
sleep 5

# Run migrations (only if database exists)
if [ -n "$DATABASE_URL" ] || [ -n "$MYSQL_URL" ]; then
    echo "📊 Running database migrations..."
    php artisan migrate --force || echo "Migration failed, continuing..."
    
    echo "🌱 Seeding database..."
    php artisan db:seed --force || echo "Seeding failed, continuing..."
fi

# Clear and optimize Laravel
echo "⚙️ Optimizing Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Start the application
echo "✅ Starting PHP server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}