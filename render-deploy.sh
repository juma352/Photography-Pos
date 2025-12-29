#!/bin/bash

# Render Deployment Script
# This script is called by the Dockerfile entrypoint

echo "🚀 Starting Mawingu Photography Portfolio deployment..."

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
MAX_TRIES=30
COUNT=0

until php artisan migrate:status 2>/dev/null || [ $COUNT -eq $MAX_TRIES ]; do
  echo "Database not ready yet... attempt $((COUNT+1))/$MAX_TRIES"
  sleep 2
  COUNT=$((COUNT+1))
done

if [ $COUNT -eq $MAX_TRIES ]; then
  echo "❌ Database connection timeout!"
  exit 1
fi

echo "✅ Database connection established"

# Run migrations
echo "📦 Running database migrations..."
php artisan migrate --force

# Run seeders (optional - only on first deploy)
if [ "$RUN_SEEDERS" = "true" ]; then
  echo "🌱 Seeding database..."
  php artisan db:seed --force
fi

# Clear and optimize cache
echo "🔧 Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink
php artisan storage:link || true

echo "✨ Deployment complete! Starting web server..."
