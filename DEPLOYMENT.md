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

## Option 2: Render

### Step 1: Sign Up
1. Go to [render.com](https://render.com)
2. Connect your GitHub account

### Step 2: Create Web Service
1. Click "New +"
2. Select "Web Service"
3. Connect your GitHub repo
4. Configure:
   - **Build Command**: `composer install && npm install && npm run build`
   - **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`

### Step 3: Database
1. Create "PostgreSQL" service
2. Copy connection details
3. Add to environment variables

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