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

## Homepage community data

The homepage uses cached Packagist download counts, GitHub stars, and contributors
from the package and website repositories. Each page load shows up to six
contributors in random order. Refresh the data immediately with:

```bash
php artisan app:refresh-community
```

The Laravel scheduler runs this command daily. Homepage visits also refresh stale
or missing data after sending the response, so a queue worker is not required.
Failed refreshes retain the last successful values and retry after at least ten
minutes. The public APIs do not require a token.
