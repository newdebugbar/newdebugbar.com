# New Debug Bar website

This is the Laravel application for [newdebugbar.com](https://newdebugbar.com).

The current foundation includes the responsive landing-page navigation and hero. The rest of the site architecture and content will follow as the product direction is defined.

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
