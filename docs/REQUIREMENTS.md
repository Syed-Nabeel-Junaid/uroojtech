# Requirements — Urooj Tech MVP

## Public Pages
- **Home** — hero, branding, Shop CTA, featured products, categories, "Why Urooj Tech",
  promotional section, footer.
- **Shop** — product grid with image/name/price/sale price/category/brand; filters
  (category, brand, price range); search; sorting (newest, price asc, price desc);
  pagination via query parameters (e.g. `/shop?category=laptops&brand=dell&sort=price_asc`).
- **Product Details** — image, name, SKU, price/sale price, short + full description,
  specifications, brand, category, stock/availability, quantity selector, Add to Cart.
- **Cart** — session-based; add/update quantity/remove product; subtotal/total; continue
  shopping; proceed to checkout; handles empty cart, invalid product, invalid quantity,
  quantity exceeding stock, and product no longer available.
- **Checkout** — requires authentication (guest → login/register → checkout); customer
  info (name/email/phone); shipping info (address/city/state/postal code/country); order
  summary (products/quantity/subtotal/total); Place Order button; no real payment.
- **About** — placeholder content only, no invented company history/claims.
- **Contact** — contact form (name/email/subject/message/send); placeholder contact
  details; structured so SMTP delivery can be added later (not implemented yet).
- **Privacy Policy** — concise, covers visitors, accounts, contact forms, cookies/sessions,
  customer data, checkout data.
- **Terms & Conditions** — concise, covers usage, accounts, products/pricing/availability,
  checkout/orders, IP, liability, changes to terms, contact info.

## Customer Functionality
- Register
- Login
- Logout
- Forgot password
- Password reset
- Account dashboard (name, email, basic info)
- Profile management (name, email, phone)
- Password change

## Admin Functionality
- Admin login/access via the shared `users` table with `role = admin`, protected by
  middleware
- Dashboard with basic stats: total products, total categories, total customers, featured
  products
- Product CRUD: view, create, edit, delete, activate/deactivate, mark featured
- Category CRUD: view, create, edit, delete (guarded against deleting categories with
  dependent products), activate/deactivate
- Customer listing and read-only customer details (name, email, phone, account status,
  registration date)

## Explicitly Out of Scope
The following are **not** part of this MVP and are deferred to future phases:
- Payment gateway integration (Stripe, PayPal, JazzCash, Easypaisa, or any other)
- Real payment processing
- Full order management / order tracking
- Shipping API or shipping provider integration
- Advanced inventory or warehouse management
- Tax engine
- Coupons / discount engine
- Wishlist
- Product reviews / ratings
- Loyalty program
- Subscription system
- Multi-vendor support
- Multi-currency support
- Multi-language support
- Advanced analytics
- Marketing automation / email marketing
- Recommendation engine / AI features
- CRM / customer support ticketing system
- Advanced RBAC / complex permissions system
- Mobile application
- REST API
