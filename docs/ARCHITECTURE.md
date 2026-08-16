# Architecture — Urooj Tech

## Overview
Standard Laravel 12 monolith. Blade + Tailwind CSS on the server-rendered front end,
Eloquent models, controllers, and Form Requests on the back end. All three logical areas
(public storefront, customer account, admin dashboard) live in this single application,
sharing one authentication system and one `users` table.

## Front End
- **Blade** for all views; Blade components where genuinely reusable (e.g. product card,
  layout shells).
- **Tailwind CSS 4**, wired through the official `@tailwindcss/vite` plugin
  (`vite.config.js`, `resources/css/app.css`) — this is Laravel 12's default scaffold, no
  extra setup was needed.
- **Alpine.js** only where a small bit of client-side interactivity is genuinely useful
  (e.g. mobile nav toggle, quantity stepper). Not used as a general state-management layer.

## Database Structure
Intentionally minimal. At this stage:
- `users` — shared by customers and admins (see Roles below)
- `categories` — product categories
- `products` — belongs to a category
- Laravel's standard framework tables (`cache`, `jobs`, `sessions`/`password_reset_tokens`
  via the default migrations)

No `orders`, `order_items`, `payments`, `shipments`, or cart tables exist yet — see
Session Cart and Checkout below for why.

## Product / Category Relationships
`Product belongsTo Category`, `Category hasMany Products` — a single, simple
one-to-many relationship. Category deletion is guarded in the controller/service layer
when products still reference it (soft-block with a user-facing message, not a DB
constraint failure).

## User Roles & Authentication
- One `users` table, one authentication system (Laravel's standard scaffolding —
  registration, login, logout, password reset).
- A simple `role` column distinguishes `customer` from `admin`. No separate admin guard,
  no separate admin user table, no complex RBAC/permissions package.
- Admin routes are grouped behind route-level middleware (e.g. `auth` + an `is_admin`
  check) so customers get a proper authorization response (403) rather than silently
  redirecting.

## Session Cart
The shopping cart is stored in the Laravel session, not a database table. This keeps the
MVP simple and avoids modeling guest-vs-authenticated cart merging. Cart contents are an
array of `{product_id, quantity}` keyed by product ID, validated against live product
data (price, stock, status) on every read so stale or invalid entries are caught rather
than trusted.

## Checkout (Current Phase)
Checkout requires authentication and collects customer + shipping information, then shows
an order summary. Because no payment gateway is integrated yet, "Place Order" ends the
flow with a minimal confirmation state rather than persisting to a full orders schema.
Once real payment/order processing is scoped, `orders`/`order_items` tables will be added
deliberately at that point — not preemptively now.

## Business Configuration
Business-identifying values (site name, contact email/phone/address, social links) will be
centralized in a single Laravel config file (`config/business.php`, values sourced from
`.env`) rather than hardcoded across Blade templates, so the real Urooj Tech details can be
dropped in later without touching views. This config file will be introduced when the
storefront pages that consume it are built (About/Contact/footer), not before.

## Technologies Intentionally NOT Used
React, Vue, Inertia, Livewire, REST API layer, repository pattern, microservices, Docker,
complex state-management libraries — all rejected in favor of standard, boring Laravel
MVC conventions appropriate for an MVP of this size. See
[PROJECT_CONTEXT.md](PROJECT_CONTEXT.md) for the reasoning and
[REQUIREMENTS.md](REQUIREMENTS.md) for the full out-of-scope feature list.

## Key Architectural Decisions Log
- **MySQL over SQLite**: the Laravel 12 installer defaults to SQLite; switched to MySQL in
  `.env` per project requirements. Local dev database name: `urooj_tech`.
- **Tailwind CSS 4 kept as scaffolded**: Laravel 12's default `laravel/laravel` skeleton
  already ships Tailwind 4 via Vite, so no Breeze/Jetstream/UI starter kit was installed —
  avoids pulling in Livewire/Inertia transitively.
- **No cart table**: deferred per spec; session is sufficient for MVP scope.
- **No orders schema yet**: deferred until real checkout/payment scope is defined, to avoid
  building infrastructure for a feature not yet authorized.
