# Mostafa Saeed Portfolio + Admin Suite

A Laravel 11 application featuring a public multilingual portfolio site and an authenticated admin dashboard for CMS, CRM, and accounting workflows.

## Features

- Public portfolio pages (Home, About, Services, Projects, Clients, Contact)
- Admin dashboard with CMS, CRM, and Accounting modules
- English + Arabic localization with RTL support
- RBAC using spatie/laravel-permission
- PDF invoice generation using barryvdh/laravel-dompdf
- Demo data seeders

## Requirements

- PHP 8.2+
- MySQL 8+
- Node.js 18+

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan storage:link
php artisan serve
```

> **Note:** The app expects a Vite build manifest in `public/build/manifest.json` when running without the dev server. Run `npm run build` (or `npm run dev`) to generate it.

## Admin Login

- Email: `admin@example.com`
- Password: `password`

## Localization

- Default locale: English
- Switch language using the EN/AR links on the public site or dashboard.

## Notes

- Uploaded files are stored under `storage/app/public`.
- Tailwind CSS automatically switches to RTL when Arabic is active.
