# 🚀 Mawingu Photography Portfolio - Deployment Guide

## Option 1: Railway (Recommended - Easiest)

### Step 1: Prepare Your Repository
1. Push your code to GitHub
2. Make sure all files are committed including:
   - `Procfile`
   - `railway.json` 
   - `railway-deploy.sh`

### Step 2: Deploy to Railway
1. Go to [railway.app](https://railway.app)
2. Sign up with GitHub
3. Click "Deploy from GitHub repo"
4. Select your Photography-Portfolio repository
5. Railway will automatically:
   - Detect Laravel
   - Set up PHP environment
   - Install dependencies
   - Run migrations

### Step 3: Add Database
1. In Railway dashboard, click "Add Service"
2. Select "MySQL" or "PostgreSQL"
3. Railway will auto-connect it to your app

### Step 4: Environment Variables
Add these in Railway dashboard:
```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://your-app-name.railway.app

DB_CONNECTION=mysql
DB_HOST=YOUR_DB_HOST
DB_PORT=3306
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USER
DB_PASSWORD=YOUR_DB_PASS
```

### Step 5: Custom Domain (Optional)
1. In Railway, go to "Domains"
2. Add your custom domain
3. Update DNS records as instructed

---

## Option 2: Render (Docker Deployment)

### Method A: Using render.yaml (Recommended)

Your repository already has a `render.yaml` file configured. This makes deployment automatic!

#### Step 1: Sign Up & Connect
1. Go to [render.com](https://render.com)
2. Sign up and connect your GitHub account
3. Click "New +" → "Blueprint"
4. Select your Photography-Portfolio repository
5. Render will automatically detect `render.yaml` and set everything up

#### Step 2: Create Database (PostgreSQL)
Render Blueprints do **not** auto-create databases. Do this first:
1. In Render Dashboard click "New +" → "PostgreSQL"
2. Region: Frankfurt; Plan: Starter ($7) or Free
3. Note the **internal connection** values (host, db, user, password, port 5432)

#### Step 3: Environment Variables
Render will prompt you to set these (or add them in Dashboard):
```
APP_KEY=base64:YOUR_KEY_HERE  # Generate with: php artisan key:generate --show
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.onrender.com
DB_CONNECTION=pgsql
DB_HOST=<from_postgres_internal_url>
DB_PORT=5432
DB_DATABASE=<from_postgres_internal_url>
DB_USERNAME=<from_postgres_internal_url>
DB_PASSWORD=<from_postgres_internal_url>
```

#### Step 4: Deploy!
- Click "Apply" and Render will:
   - Build your Docker image
   - Deploy your app
   - Run migrations automatically

---

### Method B: Manual Docker Deployment

#### Step 1: Create PostgreSQL Database
1. In Render Dashboard, click "New +"
2. Select "PostgreSQL"
3. Choose instance type (Starter is $7/month or Free tier)
4. Click "Create Database"
5. Copy the **Internal Database URL** (looks like: `postgres://user:pass@host:port/dbname`)

#### Step 2: Create Web Service
1. Click "New +" → "Web Service"
2. Connect your GitHub repository
3. Configure:
   - **Name**: `photography-portfolio`
   - **Region**: Choose closest to Germany (Frankfurt if available)
   - **Branch**: `main`
   - **Runtime**: **Docker**
   - **Instance Type**: Starter ($7/month) or Free

#### Step 3: Environment Variables
Add these in the "Environment" section:
```
APP_NAME=Mawingu Photography
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_TIMEZONE=Europe/Berlin
APP_URL=https://your-app-name.onrender.com

DB_CONNECTION=pgsql
DB_HOST=<from_database_internal_url>
DB_PORT=5432
DB_DATABASE=<from_database_internal_url>
DB_USERNAME=<from_database_internal_url>
DB_PASSWORD=<from_database_internal_url>

SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stack
LOG_LEVEL=error
```

#### Step 4: Deploy Command (Optional)
Add a deploy script in Render Dashboard under "Settings" → "Build & Deploy":
```bash
php artisan migrate --force && php artisan db:seed --force && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

#### Step 5: Deploy!
Click "Create Web Service" and Render will:
1. Pull your code
2. Build the Docker image
3. Start the container
4. Make your site live

---

### Render Docker Advantages:
✅ Automatic HTTPS
✅ Auto-deploy on git push
✅ Container isolation
✅ Better performance than buildpacks
✅ European data centers available
✅ DDoS protection included

### Troubleshooting Render:
- **503 Error**: Check logs for migration/seed issues
- **Database Connection**: Verify DB credentials in environment variables
- **Static Assets**: Ensure `npm run build` completed successfully in Docker build
- **Permissions**: Storage directory permissions are handled in Dockerfile

---

## Option 3: Heroku

### Step 1: Install Heroku CLI
```bash
# Download from heroku.com/cli
```

### Step 2: Deploy
```bash
heroku create your-portfolio-name
heroku addons:create heroku-postgresql:mini
git push heroku main
heroku run php artisan migrate --force
heroku run php artisan db:seed --force
```

---

## 🌍 For Your German Client

**Recommended Order:**
1. **Railway** - Fastest setup, great performance in Europe
2. **Render** - Good European coverage, reliable
3. **Heroku** - Most established, but slower in Europe

### Performance Tips:
- Use a CDN like Cloudflare (free)
- Optimize images before uploading
- Enable caching in production

---

## 📱 Quick Test Commands

After deployment, test these URLs:
- `https://your-domain.com/` - Home page
- `https://your-domain.com/gallery` - Collections
- `https://your-domain.com/about` - About page
- `https://your-domain.com/contact` - Contact form

---

## 🔧 Troubleshooting

### Common Issues:
1. **Database not connected**: Check environment variables
2. **Assets not loading**: Run `npm run build` before deployment
3. **500 Error**: Check logs for missing environment variables
4. **Images not showing**: Verify file paths in collections

### Debug Commands:
```bash
# Check logs
heroku logs --tail  # For Heroku
# Railway/Render have web-based log viewers

# Clear cache
php artisan cache:clear
php artisan config:clear
```

---

## 💰 Cost Comparison (Free Tiers)

| Platform | Free Limits | Database | Custom Domain |
|----------|------------|----------|---------------|
| Railway | $5 credit/month | MySQL/PostgreSQL | ✅ |
| Render | 750 hours/month | PostgreSQL | ✅ |
| Heroku | Limited hours | PostgreSQL | ✅ |

**Recommendation**: Start with Railway for easiest setup!