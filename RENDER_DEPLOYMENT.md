# 🚀 Render Docker Deployment Checklist

## Pre-Deployment

- [ ] All code committed and pushed to GitHub
- [ ] Environment variables prepared (especially `APP_KEY`)
- [ ] Database credentials ready
- [ ] Custom domain configured (optional)

## Generate APP_KEY

Run this command locally to generate your application key:
```bash
php artisan key:generate --show
```
Copy the output (including `base64:` prefix) for use in Render environment variables.

### Option 1: Blueprint (Automatic - Recommended)
1. [ ] Push `render.yaml` to your repository
2. [ ] Go to [render.com](https://render.com) Dashboard
3. [ ] Click "New +" → "Blueprint"
4. [ ] Select your repository
5. [ ] Create PostgreSQL database (Render Dashboard → New + → PostgreSQL)
6. [ ] Copy internal DB details (host, db, user, password, port 5432)
7. [ ] When prompted, set env vars: APP_KEY, DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
8. [ ] Click "Apply"
9. [ ] Wait for deployment (5-10 minutes)
10. [ ] Visit your URL!

### Option 2: Manual Docker Deployment
1. [ ] Create PostgreSQL database in Render
2. [ ] Copy database credentials
3. [ ] Create new Web Service (Runtime: Docker)
4. [ ] Add all environment variables (including DB_*)
5. [ ] Deploy

### Step 3: Database (PostgreSQL)
1. Create "PostgreSQL" service
2. Copy internal connection details (host, db, user, password, port 5432)
3. Add to environment variables

## Post-Deployment

- [ ] Visit your app URL: `https://your-app.onrender.com`
- [ ] Test image uploads
- [ ] Create admin user (if needed): `php artisan migrate --seed`
- [ ] Configure custom domain (Settings → Custom Domains)
- [ ] Enable auto-deploy on push (Settings → Build & Deploy)

## Environment Variables Checklist

Required variables in Render:
- [ ] `APP_KEY` - Generated from `php artisan key:generate --show`
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL=https://your-app.onrender.com`
- [ ] `DB_CONNECTION=pgsql`
- [ ] `DB_HOST` - From Render PostgreSQL internal connection
- [ ] `DB_PORT=5432`
- [ ] `DB_DATABASE` - From Render PostgreSQL
- [ ] `DB_USERNAME` - From Render PostgreSQL
- [ ] `DB_PASSWORD` - From Render PostgreSQL

Optional but recommended:
- [ ] `APP_TIMEZONE=Europe/Berlin`
- [ ] `SESSION_DRIVER=database`
- [ ] `CACHE_STORE=database`

## Troubleshooting

### App won't start
- Check Render logs: Dashboard → Logs
- Verify all environment variables are set
- Ensure `APP_KEY` is properly formatted with `base64:` prefix

### Database connection failed
- Verify PostgreSQL is running
- Check DB credentials match
- Use **internal** database URL, not external

### 500 Error
- Check logs: `Dashboard → Logs → Application`
- Verify `.env` variables
- Run: `php artisan config:clear` (via shell in Render)

### Static assets not loading
- Check if `npm run build` completed in Docker logs
- Verify `public/build/manifest.json` exists
- Clear cache: `php artisan cache:clear`

## Useful Render Commands

Access shell in Render Dashboard → Shell:
```bash
# Clear all caches
php artisan optimize:clear

# Re-run migrations
php artisan migrate:fresh --force --seed

# Check configuration
php artisan config:show

# Generate new app key
php artisan key:generate --show
```

## Cost Estimation

**Starter Plan (Recommended):**
- Web Service: $7/month
- PostgreSQL Database: $7/month
- **Total: $14/month**

**Free Plan (Limited):**
- Web Service: Free (spins down after inactivity)
- PostgreSQL: Free (shared resources)
- **Total: $0/month** (slower, free tier database)

## Support

- Render Documentation: https://render.com/docs
- Laravel Deployment: https://laravel.com/docs/deployment
- GitHub Issues: Create an issue in your repository
