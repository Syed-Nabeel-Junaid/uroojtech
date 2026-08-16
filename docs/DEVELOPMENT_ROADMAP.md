# Development Roadmap — Urooj Tech

Primary progress tracker for the MVP. Update phase status as work lands; do not mark a
phase complete until it has been tested per the project's testing guidelines.

Legend: ⬜ Not started · 🟨 In progress · ✅ Complete

## Phase 1 — Foundation & Authentication
Status: ✅ Complete

- [x] Initialize Laravel 12 project (Composer)
- [x] Configure MySQL connection (`urooj_tech` database)
- [x] Confirm Tailwind CSS 4 / Vite scaffold
- [x] Run baseline migrations against MySQL
- [x] Install npm dependencies, verify `npm run build`
- [x] Create `docs/` (this file + the other three)
- [x] Initialize git repository, baseline commit of the project scaffold
- [x] Add `role` and `phone` columns to `users` (customer/admin) + admin authorization middleware
- [x] Wire up standard Laravel auth (register/login/logout/forgot password/reset password)
- [x] Customer account foundation (dashboard, profile edit, password change)
- [x] Admin dashboard shell, protected by `auth` + `admin` middleware
- [x] Development admin seeder (`AdminUserSeeder`, credentials via `.env`)
- [x] Feature tests for registration, login/logout, password reset, admin authorization,
      account access

## Phase 2 — Database, Products & Categories
Status: ✅ Complete

- [x] `categories` migration + model (`name`, `slug`, `description`, `status`)
- [x] `products` migration + model (name, slug, sku, category_id, brand, price,
      sale_price, short_description, description, specifications, stock, status,
      featured, image)
- [x] Category/Product Eloquent relationship (`Category::products()` /
      `Product::category()`), enforced with a DB-level restrict-on-delete foreign key
- [x] Seeders: 10 realistic technology categories + 21 demo products (fictional brand
      names, shared placeholder SVG image, several marked featured/on sale)
- [x] Feature tests for the relationship, JSON specifications casting, stock helper, and
      the safe-delete guard

## Phase 3 — Public Storefront
Status: ✅ Complete

- [x] Home page (hero, featured products, category tiles, why-us, promo CTA, footer)
- [x] Shop listing page (grid, category/brand/price filters, search, sort, pagination)
- [x] Minimal product detail page so Shop's "View Product" links resolve (full quantity
      selector / Add to Cart wiring is Phase 4 — buttons are visibly present but
      disabled with a "Available in Phase 4" note until the session cart exists)
- [x] Reusable `<x-product-card>` Blade component shared by Home and Shop
- [x] Shop nav link wired into the shared layout (About/Contact/Cart stay unlinked
      until Phase 4/7 build those pages, to avoid dead links)
- [x] Feature tests for home content, shop filtering/search/sort/pagination, and the
      product detail page (incl. 404 for inactive products)

## Phase 4 — Product Details & Cart
Status: ✅ Complete

- [x] Product details page fully wired up: functional quantity selector (clamped to
      stock via HTML `max` + server-side validation) and working Add to Cart
- [x] Session-based cart (`App\Support\Cart`) — stores only `{product_id: quantity}` in
      the session; price/stock/status are always re-read live from the database, never
      trusted from session state
- [x] Add / update / remove routes and `CartController`, `cart.index` view (table,
      subtotal, total, empty state, Continue Shopping, Proceed to Checkout placeholder
      disabled until Phase 5)
- [x] Add to Cart wired up on the Shop grid (`<x-product-card>`) and product detail page
- [x] Cart item-count badge in the nav (shared via a `View::composer` on the layout)
- [x] Validation/edge cases handled: empty cart, invalid product, invalid quantity,
      quantity clamped to available stock (on add and on every cart view), product
      deactivated/removed after being added to cart
- [x] Feature tests covering all of the above (14 new tests)

## Phase 5 — Customer Account & Checkout
Status: ✅ Complete

- [x] Customer account dashboard, profile edit, password change (built in Phase 1)
- [x] Checkout requires authentication; guests are redirected to login and returned to
      `/checkout` afterward via Laravel's `intended()` (verified in both automated tests
      and a live browser walkthrough)
- [x] Checkout form: customer info (name/email/phone, pre-filled from the account) and
      shipping info (address/city/state/postal code/country), both server-validated
- [x] Order summary on the checkout page (products, quantity, subtotal, total) sourced
      from the same live-validated cart data used on the cart page
- [x] Empty-cart guard: checkout redirects to the cart page with a clear message if
      there's nothing to check out (both on page load and on submit)
- [x] Place Order — no payment gateway, no persistent orders table (per spec). Clears the
      session cart and shows a one-time confirmation page (order number, customer info,
      shipping address, order summary) via a single-use session flash; revisiting the
      confirmation URL without a fresh order redirects to the shop
- [x] "Proceed to Checkout" on the cart page now links to the real checkout flow
- [x] Fixed a session-fixation gap found during manual testing: registration now calls
      `session()->regenerate()` after login, matching the login controller's behavior
- [x] Feature tests: guest redirect, intended-URL return-to-checkout after login,
      empty-cart guard, order form validation, successful order (cart cleared +
      confirmation content), confirmation page guarded against direct/stale access

## Phase 6 — Admin Dashboard
Status: ✅ Complete

- [x] Admin dashboard stats (real counts: total products, categories, customers,
      featured products) with quick links to Products/Categories/Customers
- [x] Product CRUD: list (paginated), create, edit, delete, activate/deactivate toggle,
      featured toggle. Optional image upload to the `public` disk (falls back to the
      shared placeholder SVG when omitted); specifications entered as simple
      "Key: Value" lines and parsed into the JSON column
- [x] Category CRUD: list (paginated, with product counts), create, edit, delete,
      activate/deactivate toggle. Safe delete: blocked with a friendly message when
      products still reference the category (backed by the Phase 2 DB-level
      `restrictOnDelete` constraint as a hard guarantee)
- [x] Customer listing (search by name/email, paginated) and read-only customer detail
      view (name, email, phone, account status derived from email verification,
      registration date) — admins are excluded from the customer list/detail views
- [x] Admin sidebar nav wired up (Dashboard/Products/Categories/Customers) with
      active-state highlighting
- [x] Fixed a bug found during testing: `FormRequest::validated()` omits keys the
      request never submitted at all, which broke slug auto-generation on raw
      (non-browser) requests — fixed in both `ProductController` and `CategoryController`
- [x] Feature tests: customer/admin authorization on every admin route, full product CRUD
      incl. validation (unique SKU, sale price < price) and image upload (verified via
      `Storage::fake()`, since this machine's PHP CLI has no GD extension — deliberately
      did not modify the shared system-wide `php.ini` to add it), full category CRUD
      incl. the safe-delete guard both ways, customer list/search/detail and admin
      exclusion (22 new tests)
- [x] Fixed a pre-existing flaky test found while re-running the suite: `ShopTest`'s
      search test relied on `ProductFactory`'s random brand pool, which itself includes
      "Kestrel" — about a 1-in-5 chance the "non-matching" product would randomly get
      that brand and legitimately match the search. Pinned brand/short_description
      explicitly in that test.

## Phase 7 — Static Pages & Contact
Status: ✅ Complete

- [x] Central business/contact configuration (`config/business.php`, sourced from
      `BUSINESS_*` env vars) — name, email, phone, address, hours, social links, all
      placeholders per spec; consumed by the footer, Contact page, and About page instead
      of hardcoding business details in templates
- [x] About Us — placeholder content only; explicitly does not claim real company
      history, certifications, offices, or awards
- [x] Contact Us — form (name/email/subject/message) with server-side validation;
      submissions are logged (`Log::info`) rather than actually emailed, since real SMTP
      delivery is out of scope for this MVP — Laravel's mail config (`config/mail.php`,
      `MAIL_*` env vars) is already in place for that to be added later without
      restructuring anything here
- [x] Privacy Policy — concise, covers visitors, accounts, contact forms,
      cookies/sessions, customer information, and checkout information; explicitly notes
      it hasn't been legally reviewed
- [x] Terms & Conditions — concise, covers usage, accounts, products/pricing/
      availability, checkout/orders (explicitly notes no real payment/fulfillment yet),
      IP, liability, changes to terms, and contact info
- [x] Footer expanded site-wide: business contact info + links to About/Contact/Privacy/
      Terms (previously just a copyright line)
- [x] Header nav: added About and Contact links now that those routes exist
- [x] Feature tests for all four pages, contact form validation, contact form
      submission (logged, confirmed via `Log::shouldReceive`), and the footer showing
      business config values (7 new tests)

## Phase 8 — UI Polish & Final Testing
Status: ✅ Complete

**Product imagery (Goal C)**
- [x] Replaced all 21 seeded products' placeholder image with real, category-matched
      product photography downloaded as local files under `public/images/products/`
      (Unsplash + Pexels, free-use licenses) — no external image URLs at runtime
- [x] Caught and replaced 8 images that were wrong on inspection: two showed a visible
      Apple logo, one said "MacBook Air" in the UI, two were iMacs standing in for a
      standalone monitor, one showed a Logitech logo, one was on-ear headphones branded
      "aedle" mislabeled as earbuds, one was an Epson printer mislabeled as a USB charger,
      and one was a bare circuit board mislabeled as a microSD card — every replacement
      was visually verified before use, not just description-matched
- [x] `ProductSeeder` now maps each product's slug to `images/products/{slug}.jpg`
      instead of a single shared placeholder

**UI/UX polish (Goals A & B)**
- [x] Added a proper mobile navigation menu (storefront header + admin sidebar), using a
      native `<details>`/`<summary>` disclosure — no JavaScript dependency required
- [x] Fixed a real accessibility gap: every text input across the app suppressed the
      focus outline (`focus:outline-none`) with only a subtle border-color change as the
      replacement — added a visible focus ring site-wide (44 occurrences across 12 files)
- [x] Cart table lacked horizontal-scroll protection on narrow viewports — added
      (matches the pattern already used on all three admin tables)
- [x] SEO basics: page titles now consistently follow "Page — Urooj Tech"; added a meta
      description tag with sensible defaults, overridden with real content on Home, Shop,
      and each Product Details page
- [x] Active-state nav highlighting (storefront and admin)

**Technical/performance cleanup (Goal D)**
- [x] Fixed a real N+1 query: `Cart::items()` ran one `Product::find()` per cart line
      item; now batches with a single `whereIn()` lookup
- [x] Removed unused JavaScript: `axios` and `bootstrap.js` were part of the Laravel
      starter scaffold but never actually called anywhere in the app — removed both,
      shrinking the compiled JS bundle from ~48KB to ~0KB
- [x] Route review (`route:list`): no duplicates, no debug/test routes, every admin route
      correctly gated behind `auth` + `admin` middleware
- [x] Code scan for `dd()`/`dump()`/TODO/hardcoded credentials/placeholder text
      ("Lorem ipsum", "test@test.com," "Image Coming Soon") — none found (two harmless
      false-positive regex matches on `->add(`)
- [x] Verified `.env` stays gitignored, no secrets in source, all config
      (database/mail/cache/session/business) is environment-driven

**Testing (Goal D)**
- [x] Full regression: `php artisan test` — 93/93 passing, unchanged pass count
      throughout Phase 8 (polish work, not new features)
- [x] Manual responsive audit at 375px, 768px, 1920px across Home, Shop, Product Details,
      Cart, Checkout, Register, Terms, and both Admin Dashboard/Products — no horizontal
      overflow found at any breakpoint after the cart-table fix
- [x] Verified the mobile menu actually opens and stays within the viewport
- [x] Manual end-to-end walkthrough: add-to-cart, cart page rendering with real images,
      checkout, and admin pages all confirmed working with the new imagery

**Hostinger deployment readiness (Goal E)**
- [x] `npm run build` succeeds cleanly
- [x] Full fresh-migration cycle verified (`migrate:fresh --seed --force`) — exactly what
      a first deploy to Hostinger would run
- [x] `php artisan config:cache`, `route:cache`, and `view:cache` all complete without
      error — the most common way a Laravel app silently breaks on shared hosting.
      **Caught a real side effect while testing this**: with config cached, `phpunit.xml`'s
      SQLite test-database override stopped taking effect, so `php artisan test` ran its
      `RefreshDatabase` migrations against the real local MySQL `urooj_tech` database
      instead of the intended in-memory SQLite one — wiping the seeded catalog data.
      Cleared the cache and re-ran `migrate:fresh --seed --force` to restore it. Worth
      knowing for local development: never run `php artisan test` while config is cached.
- [x] `composer.json`/`package.json` reviewed — no Docker, no VPS-only dependencies,
      standard Laravel 12 + Tailwind 4 stack throughout
- [x] `public/` is already the correct document root (standard Laravel layout)
- [x] Recorded the confirmed deployment target (Hostinger Business, uroojtechpk.com) in
      `PROJECT_CONTEXT.md` and `ARCHITECTURE.md`

**Documentation**
- [x] `ARCHITECTURE.md`: corrected the Alpine.js note (none was actually needed),
      corrected the category-delete description (DB constraint + controller check, not
      just controller-level), added Product Imagery and Deployment Target sections
- [x] `PROJECT_CONTEXT.md`: added Deployment Target section
- [x] This file, marking Phase 8 complete

---

## Current Status Summary
All 8 planned MVP phases are complete. The Urooj Tech storefront, customer account system,
session cart, checkout flow, admin dashboard, and static pages all work end-to-end with
real product photography, a responsive mobile-aware UI, and no known Hostinger deployment
blockers. All 93 automated tests pass. See the Phase 8 section above for the full list of
polish/testing/deployment-readiness work, and the final report delivered alongside this
update for the complete audit findings, remaining considerations, and git status.

Nothing has been committed to git — that remains a deliberate, separate step per the
project's git rules.
