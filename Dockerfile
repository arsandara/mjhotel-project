#!/bin/bash

# Script untuk setup Laravel di Fly.io
# Usage: ./setup-flyio.sh mjhotel-project

APP_NAME=${1:-mjhotel-project}

echo "🚀 Setting up Laravel for Fly.io app: $APP_NAME"
echo "================================================"

echo ""
echo "📁 Step 1: Creating required directories..."
fly ssh console --app $APP_NAME -C "mkdir -p storage/framework/sessions"
fly ssh console --app $APP_NAME -C "mkdir -p storage/framework/views"
fly ssh console --app $APP_NAME -C "mkdir -p storage/framework/cache"
fly ssh console --app $APP_NAME -C "mkdir -p storage/framework/cache/data"
fly ssh console --app $APP_NAME -C "mkdir -p storage/logs"
fly ssh console --app $APP_NAME -C "mkdir -p bootstrap/cache"

echo ""
echo "🔐 Step 2: Setting permissions..."
fly ssh console --app $APP_NAME -C "chown -R www-data:www-data storage"
fly ssh console --app $APP_NAME -C "chown -R www-data:www-data bootstrap/cache"
fly ssh console --app $APP_NAME -C "chmod -R 775 storage"
fly ssh console --app $APP_NAME -C "chmod -R 775 bootstrap/cache"

echo ""
echo "🧹 Step 3: Clearing Laravel caches..."
fly ssh console --app $APP_NAME -C "php artisan cache:clear"
fly ssh console --app $APP_NAME -C "php artisan config:clear"
fly ssh console --app $APP_NAME -C "php artisan view:clear"
fly ssh console --app $APP_NAME -C "php artisan route:clear"

echo ""
echo "📋 Step 4: Optimizing application..."
fly ssh console --app $APP_NAME -C "php artisan config:cache"
fly ssh console --app $APP_NAME -C "php artisan route:cache"
fly ssh console --app $APP_NAME -C "php artisan view:cache"

echo ""
echo "✅ Step 5: Verifying directory structure..."
fly ssh console --app $APP_NAME -C "ls -la storage/framework"

echo ""
echo "🔄 Step 6: Restarting application..."
fly apps restart $APP_NAME

echo ""
echo "✨ Setup complete!"
echo ""
echo "📌 Next steps:"
echo "   1. Check if APP_KEY is set: fly secrets list --app $APP_NAME"
echo "   2. If not set, generate one: fly secrets set APP_KEY=\$(php artisan key:generate --show) --app $APP_NAME"
echo "   3. Check logs: fly logs --app $APP_NAME"
echo "   4. Visit your app: fly open --app $APP_NAME"
echo ""