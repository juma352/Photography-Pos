# 📊 Render Docker Deployment Architecture

## Deployment Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                         LOCAL MACHINE                            │
│                                                                  │
│  1. Generate APP_KEY: php artisan key:generate --show          │
│  2. Push code to GitHub: git push origin main                  │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                           GITHUB                                 │
│                                                                  │
│  Repository with:                                               │
│  ✓ Dockerfile                                                   │
│  ✓ render.yaml                                                  │
│  ✓ render-deploy.sh                                            │
│  ✓ Laravel application code                                    │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                      RENDER PLATFORM                             │
│                                                                  │
│  3. Blueprint detects render.yaml                               │
│  4. Creates two services:                                       │
│                                                                  │
│  ┌──────────────────────────┐  ┌──────────────────────────────┐│
│  │    MySQL Database        │  │     Web Service (Docker)     ││
│  │                          │  │                              ││
│  │  - Auto-provisioned      │◄─┤  - Builds Docker image      ││
│  │  - Internal connection   │  │  - Runs migrations          ││
│  │  - Persistent storage    │  │  - Starts Apache            ││
│  │                          │  │  - Serves on port 80        ││
│  └──────────────────────────┘  └──────────────────────────────┘│
│                                                                  │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                         LIVE SITE                                │
│                                                                  │
│  https://photography-portfolio.onrender.com                     │
│  ✓ HTTPS enabled (automatic SSL)                               │
│  ✓ Auto-deploy on git push                                     │
│  ✓ Health checks enabled                                       │
└─────────────────────────────────────────────────────────────────┘
```

---

## Docker Build Process

```
Dockerfile Execution
│
├─ 1. Base Image
│   └─ PHP 8.2 with Apache
│
├─ 2. Install Dependencies
│   ├─ System packages (git, curl, etc.)
│   ├─ PHP extensions (pdo_mysql, gd, etc.)
│   └─ Composer & Node.js
│
├─ 3. Copy Application
│   ├─ Copy all files to /var/www
│   └─ Copy render-deploy.sh script
│
├─ 4. Build Application
│   ├─ composer install --no-dev
│   ├─ npm ci && npm run build
│   └─ npm prune --production
│
├─ 5. Configure Apache
│   ├─ Set document root to /var/www/public
│   ├─ Enable mod_rewrite
│   └─ Configure .htaccess support
│
├─ 6. Set Permissions
│   ├─ storage/ → 755
│   └─ bootstrap/cache/ → 755
│
├─ 7. Laravel Optimization
│   ├─ config:cache
│   ├─ route:cache
│   └─ view:cache
│
└─ 8. Runtime (Entrypoint)
    ├─ Run render-deploy.sh
    │   ├─ Wait for database
    │   ├─ Run migrations
    │   ├─ (Optional) Seed database
    │   └─ Cache configs
    └─ Start Apache server
```

---

## File Structure & Purpose

```
Photography-Portfolio/
│
├─ Dockerfile                    # Main Docker configuration
│   └─ Builds PHP + Apache + Laravel environment
│
├─ render.yaml                   # Blueprint Infrastructure-as-Code
│   ├─ Defines web service (Docker)
│   ├─ Defines MySQL database
│   └─ Sets environment variables
│
├─ render-deploy.sh             # Deployment automation script
│   ├─ Database connection check
│   ├─ Run migrations
│   ├─ Optional seeding
│   └─ Cache optimization
│
├─ .dockerignore                # Files excluded from Docker build
│   ├─ node_modules (rebuilt in container)
│   ├─ .git (not needed in production)
│   └─ tests (not needed in production)
│
├─ .env.render                  # Environment variables template
│   └─ Copy these to Render Dashboard
│
└─ Documentation/
    ├─ RENDER_QUICKSTART.md     # This file - Quick 3-step guide
    ├─ RENDER_DEPLOYMENT.md     # Detailed deployment guide
    └─ DEPLOYMENT.md            # All platform options
```

---

## Environment Variables Flow

```
Local Development               Production (Render)
─────────────────              ──────────────────

.env                           Render Dashboard
├─ APP_KEY=local_key      →    ├─ APP_KEY=production_key
├─ DB_HOST=localhost      →    ├─ DB_HOST=mysql-xxx.render
├─ APP_DEBUG=true         →    ├─ APP_DEBUG=false
└─ APP_ENV=local          →    └─ APP_ENV=production

                               render.yaml (auto-sets)
                               ├─ DB_HOST (from database service)
                               ├─ DB_PASSWORD (from database service)
                               └─ Other DB credentials
```

---

## Request Flow (Production)

```
User Browser
    │
    ▼
HTTPS (Render Edge)
    │
    ▼
Render Load Balancer
    │
    ▼
Docker Container
    │
    ├─ Apache (Port 80)
    │   │
    │   ▼
    ├─ public/index.php
    │   │
    │   ▼
    ├─ Laravel Router
    │   │
    │   ├─ /gallery → GalleryController
    │   ├─ /admin → AdminController
    │   └─ /api/* → API Routes
    │
    ▼
MySQL Database
    │
    └─ Collections, Photos, Users tables
```

---

## Scaling Options

### Current Setup (Starter Plan)
```
[Web Service] x1 instance
[MySQL DB] x1 instance
Cost: $14/month
```

### Scale Up (If needed)
```
[Web Service] x2 instances (load balanced)
[MySQL DB] x1 instance (upgraded)
Cost: ~$28-50/month
Performance: 2x faster, zero downtime
```

---

## Security Features

✅ **Built-in Security:**
- HTTPS/SSL (automatic)
- DDoS protection (Render)
- Container isolation (Docker)
- Database encryption at rest
- Private network (internal DB connection)

✅ **Application Security:**
- CSRF protection (Laravel)
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)
- Secure password hashing (bcrypt)
- Session encryption (optional)

---

## Monitoring & Logs

Access in Render Dashboard:

1. **Application Logs**
   - Path: Service → Logs tab
   - Shows: PHP errors, Laravel logs, Apache access logs

2. **Metrics**
   - Path: Service → Metrics tab
   - Shows: CPU, Memory, Request count, Response times

3. **Health Checks**
   - Path: Service → Health tab
   - Endpoint: `/` (home page)
   - Frequency: Every 30 seconds

---

## Backup Strategy

### Automated (Render)
- Database snapshots (depends on plan)
- Docker image versioning (automatic)
- Git history (source code)

### Manual Backups
```bash
# Database export (via Render Shell)
php artisan db:backup

# Or use Render's database backup feature
# Dashboard → Database → Backups
```

---

## Cost Breakdown

| Service | Free Tier | Starter | Pro |
|---------|-----------|---------|-----|
| Web Service | $0 (sleeps) | $7/mo | $25/mo |
| MySQL DB | N/A | $7/mo | $25/mo |
| SSL | ✓ Free | ✓ Free | ✓ Free |
| DDoS Protection | ✓ Free | ✓ Free | ✓ Free |
| **Total** | **$0** | **$14/mo** | **$50/mo** |

**Recommendation**: Starter plan for production client work.

---

## Next Steps After Reading

1. ✅ Review [RENDER_QUICKSTART.md](RENDER_QUICKSTART.md) for deployment
2. ✅ Generate your `APP_KEY`
3. ✅ Push to GitHub
4. ✅ Deploy on Render
5. ✅ Configure custom domain
6. ✅ Share with client!

**Questions?** Check the detailed guides or Render documentation.
