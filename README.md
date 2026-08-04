# Hamza Enterprises — Vehicle & Machinery Export Platform

A full-stack **Laravel 13** web application built for **Hamza Enterprises**, a Korea-based exporter of used vehicles, heavy machinery, and spare parts. The platform pairs a public storefront (catalog browsing, inquiries, multi-currency pricing) with a complete custom admin panel that drives every piece of content on the site — there is no hardcoded or placeholder data anywhere in the production flow.

This project began as a static HTML/CSS/JS marketing site and was rebuilt module-by-module into a real, database-backed application with authenticated admin CRUD, file uploads, and live view-count tracking.

---

## Table of contents

1. [Overview](#overview)
2. [Feature breakdown](#feature-breakdown)
3. [Architecture & design patterns](#architecture--design-patterns)
4. [Tech stack](#tech-stack)
5. [Project structure](#project-structure)
6. [Database schema](#database-schema)
7. [Routes reference](#routes-reference)
8. [Installation](#installation)
9. [Default admin credentials](#default-admin-credentials)
10. [Development conventions](#development-conventions)
11. [License](#license)

---

## Overview

| | |
|---|---|
| **Business** | Hamza Enterprises — export of used Korean vehicles, construction/heavy/agricultural machinery, and spare parts |
| **Public site** | Catalog browsing, detail pages, multi-currency pricing, WhatsApp/call inquiries, company info, events/news |
| **Admin panel** | `/admin` — full CRUD for every content type, real authentication, image uploads, dashboard analytics |
| **Framework** | Laravel 13 (PHP 8.3), Blade templating, MySQL |
| **Frontend** | Hand-written vanilla JS per page + jQuery/Select2 for the currency picker — no SPA framework, no build step required to run the app |

---

## Feature breakdown

### Public site

**Catalog modules** — Vehicles, Machinery, Parts each get:
- A listing page with live search, filter dropdowns (maker/model, body/category, fuel, price range, etc.), and pagination handled client-side over a server-injected JSON dataset
- A detail page with a photo gallery (thumbnail strip + prev/next), full specification table, a free-text description written by admin, live currency-converted pricing, and WhatsApp/phone CTAs
- Sidebar widgets ("Most Viewed" / "Popular Requests") that reflect **real click-through data**, not curated placeholders — every detail-page visit increments a `views` counter, and the top 3 by views surface in the sidebar

**Homepage** — every section is database-driven:
- Hero with admin-editable badge/headline/sub-headline and stat counters
- "Today's recommendation" — vehicles the admin has flagged `featured`, topped up with newest stock if fewer than 6 are flagged
- "Vehicles in stock" — newest available inventory
- "Browse by brand" — admin-managed brand list with uploadable logos
- "Latest exports & port operations" — the 4 most recent entries from the Events & News module
- "Hamza Enterprises TV" — admin-managed video walkarounds (thumbnail, duration, view count, external video link)
- "Our showrooms & yards" — two admin-editable location cards with address, phone, WhatsApp, and a real Google Maps directions link
- "Who you're working with" — leadership contacts and two full bank-detail cards, all admin-editable
- Testimonials carousel with per-review star rating and an optional custom avatar color

**Other pages** — Events & News (categorized: Events, Company News, Port Logs, Deliveries), FAQ, About Us, Contact Us (writes to the Inquiries module), Claim Center, Privacy Policy, Terms & Conditions, Sitemap, and a footer Newsletter signup.

**Currency system** — 139 currencies with flag emojis, a Select2-powered picker in the navbar and on every detail page, backed by live exchange rates with a cached fallback. Selection persists via `localStorage` and a `hamza:currencychange` custom event keeps every price on the page in sync without a reload.

**Mobile navigation** — accordion-style dropdowns for Vehicles/Machinery inside the hamburger menu, driven by a shared `nav-toggle.js` loaded globally.

### Admin panel (`/admin`)

| Module | Capabilities |
|---|---|
| **Dashboard** | Live counts and charts for vehicle/machinery/parts inventory status, unread inquiries |
| **Vehicles** | Full CRUD, search/filter, up to 15 drag-to-reorder photos, description field, `featured` toggle for the homepage |
| **Machinery** | Same pattern as Vehicles (up to 15 photos) |
| **Parts** | Same pattern, up to 5 photos, falls back to a generated category-icon graphic when no photo is uploaded |
| **Events & News** | CRUD with category (Events / Company News / Port Logs / Deliveries), date, author, image, summary + full content |
| **Brands** | Bulk spreadsheet-style editor — name, listing count, visibility toggle, and now a real logo upload per brand |
| **FAQ** | CRUD for question/answer pairs |
| **Testimonials** | CRUD with star rating, avatar initials, and an explicit "use a custom avatar color" checkbox (prevents accidentally overwriting the default look on every edit) |
| **Videos** | CRUD for the homepage video-walkaround section — title, external URL, duration, views, published date, thumbnail upload |
| **Inquiries** | View submissions from the Contact Us form, mark Read/Replied, delete |
| **Newsletter** | View and remove footer-signup subscribers |
| **Settings** | Hero section, company info, showrooms & yards, leadership & banking — all in one page, each saved independently |

All destructive actions (delete) go through a custom styled confirmation modal — no native browser `confirm()`/`alert()` dialogs anywhere in the panel.

---

## Architecture & design patterns

**Lazy-loaded heavy fields.** Listing queries for Vehicles/Machinery deliberately select a `LIGHT_COLUMNS` subset that excludes `images` (a JSON array that can hold up to 15 photo paths) and `description`. Those fields are fetched with a second, targeted query only for the single item being viewed on its detail page. This keeps catalog pages fast and their payload size constant regardless of how many photos are uploaded per listing.

**Real view tracking.** `views` is a genuine `unsignedInteger` column on `vehicles` and `parts`, incremented on every detail-page `show()` request. Homepage/sidebar "Most Viewed" widgets query `ORDER BY views DESC` — nothing is hand-picked or faked.

**Public data injection, unchanged frontend JS.** Public listing/detail pages keep their original client-side filtering and rendering logic (fast, no reload on filter). The controller injects the real dataset as JSON directly into an inline `<script>` tag (e.g. `const CAR_DATABASE = @json($carDatabase);`) in the exact shape the existing JS already expects, so the hand-written frontend code didn't need to be rewritten — only the data source changed, from a static file to a live database query.

**Real authentication.** Admin login uses Laravel's built-in `Auth::attempt()` against the `users` table with hashed passwords and session regeneration — not a client-side credential check. Protected routes sit behind the `auth` middleware and redirect unauthenticated visitors to `/admin`.

**File uploads.** All image uploads go through `Storage::disk('public')->store(...)`, referenced back as `/storage/...` URLs (via `php artisan storage:link`). Multi-image fields use a shared drag-and-drop JS component (per-page, not a bundled library) with a live preview grid and drag-to-reorder — the first photo in the list becomes the listing's primary image.

**No native browser dialogs.** Every delete confirmation in the admin panel uses a custom-styled modal component; upload-limit warnings render as inline text instead of `alert()`.

---

## Tech stack

| Layer | Technology |
|---|---|
| Backend framework | Laravel 13 (PHP 8.3) |
| Database | MySQL |
| Templating | Blade |
| Frontend | Vanilla JS (per-page files, no bundler required to run), jQuery + Select2 for the currency picker |
| Auth | Laravel session-based `Auth` |
| File storage | Laravel `Storage` facade, public disk |
| Admin UI | Hand-built CSS design system (`public/admin-assets/`) — no third-party admin template |

---

## Project structure

```
app/
  Http/
    Controllers/            # Public-facing controllers (Home, Vehicle, Machinery, Part, Event, Faq, Inquiry, Newsletter)
    Controllers/Admin/       # Admin panel controllers (one per module, mirrors the public ones + Auth/Dashboard/Setting/Video)
    Requests/Admin/          # Form request validation classes per module
  Models/                   # Vehicle, Machinery, Part, Event, Brand, Faq, Testimonial, Video, Inquiry,
                             # NewsletterSubscriber, Setting, User

database/
  migrations/                # One migration per table + incremental add-column migrations as features grew
  seeders/                   # Realistic seed data for every module — run via `php artisan db:seed`

resources/
  views/
    pages/                   # Public pages (home, cars, car-detail, machinery, machinery-detail, parts,
                              # part-detail, events, about-us, contact-us, faq, claim-center, sitemap, ...)
    admin/                   # Admin panel pages — a list view + a form view per CRUD module
    layouts/                 # app.blade.php (public), admin.blade.php (admin panel)
    partials/                # header, footer, topbar, SVG icon sprite

public/
  assets/                    # Public site CSS/JS/images (one JS file per page + shared globals: currency.js,
                              # currency-select.js, nav-toggle.js)
  admin-assets/               # Admin panel CSS/JS, including admin-shell.js (sidebar nav + shell renderer)
  storage -> storage/app/public   # Symlink created by `php artisan storage:link`

routes/
  web.php                    # All public + admin routes
```

---

## Database schema

| Table | Purpose |
|---|---|
| `users` | Admin login |
| `vehicles` | Car/van/truck listings — spec fields, `images` (JSON), `description`, `status`, `featured`, `views` |
| `machinery` | Construction / Heavy Equipment / Agricultural Machinery listings — same image/description/views pattern |
| `parts` | Spare parts listings — up to 5 `images`, `description`, `views` |
| `events` | Events & News posts — category, date, image, summary, content |
| `brands` | Homepage brand grid — name, logo, listing count, visibility |
| `faqs` | FAQ question/answer pairs |
| `testimonials` | Customer reviews — rating, author, location, avatar initials/color |
| `videos` | Homepage video walkarounds — title, thumbnail, external URL, duration, views, published date |
| `inquiries` | Contact Us form submissions — status (New/Read/Replied) |
| `newsletter_subscribers` | Footer newsletter signups |
| `settings` | Single-row site config: hero text/stats, company info, 2 showroom locations, 2 leadership contacts, 2 bank-detail blocks (4 label/value rows each) |

---

## Routes reference

**Public**

| Method | URI | Purpose |
|---|---|---|
| GET | `/` | Homepage |
| GET | `/cars`, `/car-detail` | Vehicle listing & detail |
| GET | `/machinery`, `/machinery-detail` | Machinery listing & detail |
| GET | `/parts`, `/part-detail` | Parts listing & detail |
| GET | `/events` | Events & News |
| GET | `/faq`, `/about-us`, `/contact-us`, `/claim-center`, `/privacy-policy`, `/terms-conditions`, `/sitemap` | Static/content pages |
| POST | `/contact-us` | Submit an inquiry |
| POST | `/newsletter` | Subscribe to the newsletter |

**Admin** (all under `/admin`, protected by `auth` middleware except login)

| Module | Routes |
|---|---|
| Auth | `GET /admin` (login form), `POST /admin/login`, `POST /admin/logout` |
| Dashboard | `GET /admin/dashboard` |
| Vehicles / Machinery / Parts / Events / Testimonials / Videos | `GET {module}`, `GET {module}-form`, `POST {module}`, `PUT {module}/{id}`, `DELETE {module}/{id}` |
| Brands | `GET /admin/brands`, `POST /admin/brands` (bulk sync) |
| FAQ | Same CRUD pattern as Vehicles |
| Inquiries | `GET /admin/inquiries`, `PATCH .../update-status`, `DELETE .../{id}` |
| Newsletter | `GET /admin/newsletter`, `DELETE .../{id}` |
| Settings | `GET /admin/settings`, `POST .../hero`, `.../company`, `.../showrooms`, `.../leadership` (independent forms, one page) |

---

## Installation

### Requirements
- PHP 8.3+
- Composer
- MySQL
- Node.js (only if you plan to touch build tooling — not required to run the app as-is)

### Steps

```bash
composer install

cp .env.example .env
php artisan key:generate
```

Set your database credentials in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hamza-enterprises
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Run migrations and seed realistic demo data — vehicles, machinery, parts, events, brands, FAQs, testimonials, videos, and site settings:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Visit `http://127.0.0.1:8000`.

To reset and re-seed at any point:

```bash
php artisan migrate:fresh --seed
```

---

## Default admin credentials

```
URL:      /admin
Email:    admin@hamzaenterprises.com
Password: Hamza@2024
```

Change this in production via the `users` table or a fresh seed with different credentials in `DatabaseSeeder.php`.

---

## Development conventions

- **New CRUD module checklist**: migration → model (`$fillable` + `$casts`) → `Http\Requests\Admin\{Module}Request` → `Http\Controllers\Admin\{Module}Controller` (index/form/store/update/destroy) → `resources/views/admin/{module}.blade.php` (list) + `{module}-form.blade.php` (form) → routes in `routes/web.php` → nav entry in `public/admin-assets/js/admin-shell.js` → seeder → register in `DatabaseSeeder`.
- **Multi-image upload forms** follow one shared pattern (see `vehicles-form.blade.php` / `machinery-form.blade.php` / `parts-form.blade.php`): a drag-and-drop zone, a `DataTransfer`-backed file list capped at a `MAX_PHOTOS` constant, drag-to-reorder preview cards, and an inline (not `alert()`) limit warning.
- **Delete confirmations** always use the shared `.modal-overlay` / `.modal` component + an `openDelete(id, label)` JS helper, never `confirm()`.
- **Keep listing queries light.** If a new field is large (rich text, JSON arrays, images), exclude it from index/listing queries and fetch it only for the specific record being shown in detail.
- Blade quirk to be aware of: nesting a `@php ... @endphp` block as the very first statement inside a `@if (...)` block has been observed to leave the `@if` uncompiled in this codebase's Blade cache in specific cases. Prefer computing values in the controller and passing them as view variables instead of using `@php` blocks inside conditionals.

---

## License

Private project — all rights reserved by Hamza Enterprises.
