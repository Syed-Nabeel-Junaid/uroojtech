# Project Context — Urooj Tech

## Project Name
Urooj Tech

## Purpose
Urooj Tech is a modern technology-products e-commerce website. This repository builds a
fast, clean, responsive **MVP**: a polished storefront, basic customer authentication and
account functionality, a basic admin dashboard, product management, a shopping cart, and a
checkout flow that stops short of real payment processing.

This is **not** a complete enterprise e-commerce platform. Speed, simplicity,
maintainability, and clean Laravel conventions are the priorities over feature breadth.

## Technology Stack
- Laravel 12 (PHP 8.2+)
- MySQL
- Blade templates
- Tailwind CSS 4 (via Vite)
- Alpine.js — only where genuinely useful
- Laravel Eloquent ORM
- Laravel session-based shopping cart (no cart database table)
- Laravel's standard authentication / password-reset scaffolding

Explicitly **not** used: React, Vue, Inertia, Livewire, REST API architecture, the
repository pattern, microservices, Docker, complex state-management libraries, or
unnecessary third-party packages. See [ARCHITECTURE.md](ARCHITECTURE.md) for the reasoning.

## MVP Objective
Deliver the core customer journey and supporting flows below, built properly rather than
built big.

**Storefront scope**
Home → Shop (listing, filters, search, sort, pagination) → Product Details → Add to Cart →
Cart → Checkout, plus About, Contact, Privacy Policy, and Terms & Conditions pages.

**Customer authentication scope**
Register, Login, Logout, Forgot Password, Reset Password — using Laravel's standard
authentication mechanisms.

**Customer account scope**
A basic account area only: dashboard (name/email/basic info), profile editing
(name/email/phone), and password change. Not a full customer portal.

**Admin dashboard scope**
Role-protected admin area (`users.role = admin`) with basic stats, Product CRUD, Category
CRUD, and read-only Customer listing/details. Not advanced analytics, CRM, or complex RBAC.

## Checkout Limitation
Checkout is intentionally basic and does **not** implement real payment processing. No
payment gateway (Stripe, PayPal, JazzCash, Easypaisa, etc.) is integrated. The "Place
Order" action represents the end of the current MVP flow; a minimal confirmation state is
enough. Full order processing/payment is a future phase.

## Business / Contact Information
All business details (contact email, phone, address, social links) shown on the site are
**placeholders**. Real Urooj Tech business information will be provided later and should
replace the placeholders via the central configuration approach described in
[ARCHITECTURE.md](ARCHITECTURE.md).

## Guiding Principle
Build less, but build it properly. Do not expand scope beyond this specification unless
explicitly instructed. See [REQUIREMENTS.md](REQUIREMENTS.md) for the full in/out-of-scope
feature list and [DEVELOPMENT_ROADMAP.md](DEVELOPMENT_ROADMAP.md) for phase-by-phase
progress.
