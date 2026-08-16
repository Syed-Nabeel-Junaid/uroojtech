# Development Roadmap — Urooj Tech

Primary progress tracker for the MVP. Update phase status as work lands; do not mark a
phase complete until it has been tested per the project's testing guidelines.

Legend: ⬜ Not started · 🟨 In progress · ✅ Complete

## Phase 1 — Foundation & Authentication
Status: 🟨 In progress

- [x] Initialize Laravel 12 project (Composer)
- [x] Configure MySQL connection (`urooj_tech` database)
- [x] Confirm Tailwind CSS 4 / Vite scaffold
- [x] Run baseline migrations against MySQL
- [x] Install npm dependencies, verify `npm run build`
- [x] Create `docs/` (this file + the other three)
- [ ] Add `role` column to `users` (customer/admin) + admin authorization middleware
- [ ] Wire up Laravel's standard auth scaffolding (register/login/logout/password reset)

## Phase 2 — Database, Products & Categories
Status: ⬜ Not started

- [ ] `categories` migration + model
- [ ] `products` migration + model (with fields per REQUIREMENTS.md)
- [ ] Category/Product Eloquent relationship
- [ ] Seeders: realistic categories + demo products

## Phase 3 — Public Storefront
Status: ⬜ Not started

- [ ] Home page (hero, featured products, categories, why-us, footer)
- [ ] Shop listing page (grid, filters, search, sort, pagination)

## Phase 4 — Product Details & Cart
Status: ⬜ Not started

- [ ] Product details page
- [ ] Session-based cart (add/update/remove, subtotal/total, validation)

## Phase 5 — Customer Account & Checkout
Status: ⬜ Not started

- [ ] Customer account dashboard, profile edit, password change
- [ ] Checkout flow (auth-gated, customer/shipping info, order summary, Place Order)

## Phase 6 — Admin Dashboard
Status: ⬜ Not started

- [ ] Admin dashboard stats
- [ ] Product CRUD (incl. activate/deactivate, featured)
- [ ] Category CRUD (incl. safe delete)
- [ ] Customer listing/details

## Phase 7 — Static Pages & Contact
Status: ⬜ Not started

- [ ] About Us
- [ ] Contact Us (form structure, no live email delivery yet)
- [ ] Privacy Policy
- [ ] Terms & Conditions
- [ ] Central business/contact configuration (`config/business.php`)

## Phase 8 — UI Polish & Final Testing
Status: ⬜ Not started

- [ ] Responsive pass (desktop/tablet/mobile)
- [ ] Empty states, validation error states
- [ ] Manual test pass per REQUIREMENTS.md testing checklist
- [ ] Final review before any Git commit (commits require explicit instruction)

---

## Current Status Summary
Phase 1 foundation is underway: Laravel 12 project created, MySQL configured and
migrated, Tailwind/Vite verified, documentation created. Auth scaffolding and the
`role` column are the next Phase 1 items, not yet started.
