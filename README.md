# New Debug Bar website

This is the Laravel application for [newdebugbar.com](https://newdebugbar.com).

The project is currently a fresh Laravel foundation. Its site architecture, frontend, and content-rendering approach are intentionally not implemented yet.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
valet link newdebugbar
```

Open [newdebugbar.test](http://newdebugbar.test).
