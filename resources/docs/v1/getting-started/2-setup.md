---
Section: Getting started
---

# Setup

To set up the new debug bar for Laravel, you need to make sure [Telescope](https://laravel.com/docs/telescope) is running.

```bash
php artisan telescope:install
````

Then, run the migrations:

```bash
php artisan migrate
```

The new debug bar for Laravel uses the data collected by Laravel Telescope and displays it in a beautiful and modern user interface.
