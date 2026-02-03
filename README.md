# Mostafa Saeed Personal Website + Admin CMS

Production-ready Laravel application for a bilingual (EN/AR) personal website with an admin CMS, CRM, and accounting foundation.

## Requirements

- PHP 8.2+
- MySQL
- Composer
- Laravel 11+ (project uses Laravel 12)

## Setup (Composer only)

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Update your `.env` with database credentials, then run:

```bash
php artisan migrate --seed
php artisan serve
```

## Admin Login

- URL: `/admin/dashboard`
- Email: `admin@example.com`
- Password: `password`

## Notes

- **No NPM required** (Bootstrap 5 + jQuery via CDN).
- Uploads are stored in `public/uploads/*` (no storage links).
- Language switch: `/lang/{locale}` (EN default, AR secondary).
