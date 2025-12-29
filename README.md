# 📸 Mawingu Photography Portfolio

A modern, elegant photography portfolio built with Laravel 11, featuring dynamic galleries, collections, and an admin dashboard for managing photos.

## ✨ Features

- 🖼️ Dynamic photo galleries with collections
- 🎨 Responsive design with Tailwind CSS
- 🔐 Admin dashboard for photo management
- 📱 Mobile-optimized viewing experience
- 🌍 Optimized for European hosting (Germany-based client)
- 🐳 Docker-ready for easy deployment

## 🚀 Quick Deploy to Render

This project is configured for one-click deployment to Render using Docker:

1. **Push to GitHub**
2. **Go to [render.com](https://render.com)**
3. **Click "New +" → "Blueprint"**
4. **Select your repository**
5. **Set your `APP_KEY`** (generate with `php artisan key:generate --show`)
6. **Click "Apply"**

✅ Done! Your site will be live in ~5-10 minutes.

📖 **Detailed Instructions**: See [RENDER_DEPLOYMENT.md](RENDER_DEPLOYMENT.md)

## 🛠️ Local Development

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL

### Setup

```bash
# Clone repository
git clone <your-repo-url>
cd Photography-Portfolio

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Build assets
npm run dev

# Start server
php artisan serve
```

Visit `http://localhost:8000`

## 📦 Deployment Options

- **Render (Docker)** - Recommended - [Guide](RENDER_DEPLOYMENT.md)
- **Railway** - Fast & Easy - [Guide](DEPLOYMENT.md#option-1-railway)
- **Heroku** - Traditional - [Guide](DEPLOYMENT.md#option-3-heroku)

## 🏗️ Tech Stack

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## 🏗️ Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Tailwind CSS
- **JavaScript**: Vite
- **Database**: MySQL
- **Deployment**: Docker (Render, Railway, Heroku compatible)

## 📁 Project Structure

```
Photography-Portfolio/
├── app/
│   ├── Models/          # Photo, Collection, User models
│   └── Http/
│       └── Controllers/ # Gallery, Admin controllers
├── resources/
│   ├── views/           # Blade templates
│   ├── css/             # Tailwind styles
│   └── js/              # Frontend JavaScript
├── public/
│   └── Images/          # Photo storage
├── database/
│   ├── migrations/      # Database schema
│   └── seeders/         # Sample data
├── Dockerfile           # Docker configuration
├── render.yaml          # Render Blueprint config
└── DEPLOYMENT.md        # Deployment guides
```

## 🔧 Configuration

### Environment Variables

Key variables for production:

```env
APP_NAME="Mawingu Photography"
APP_ENV=production
APP_KEY=base64:...
APP_URL=https://your-domain.com
APP_TIMEZONE=Europe/Berlin

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-pass
```

See [env.production](env.production) for complete configuration template.

## 📸 Admin Features

- Upload and manage photos
- Create and organize collections
- Edit photo metadata
- Gallery management
- User authentication

## 🌍 Performance

Optimized for German/European audience:
- CDN-ready static assets
- Database query optimization
- Image lazy loading
- Cached routes and views

## 📝 License

This project is proprietary software developed for Mawingu Photography.

## 🤝 Support

For deployment issues or questions:
- Check [RENDER_DEPLOYMENT.md](RENDER_DEPLOYMENT.md)
- Review [DEPLOYMENT.md](DEPLOYMENT.md)
- Contact the development team

---

Built with ❤️ using Laravel

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
