# Kids Health Hub — Build Tracker

## Project
Kids Health Hub — Phase 1 MVP  
Laravel 13 / PHP 8.3 / SQLite / TailwindCSS v3 (Breeze) / Google Maps API

---

## Milestones

| # | Milestone | Status | Notes |
|---|-----------|--------|-------|
| 1 | Foundation & Environment | ✅ Done | Breeze + Spatie installed, git init, serve OK |
| 2 | Database Migrations | ✅ Done | categories, providers, subscriptions, pivot, settings |
| 3 | Models & Relationships | ✅ Done | All models + scopes + Spatie HasRoles on User |
| 4 | Authentication & Roles | ✅ Done | Provider registration creates subscription trial + role |
| 5 | Provider Dashboard | ✅ Done | Dashboard, profile edit, availability/telehealth toggles |
| 6 | Admin Dashboard | ✅ Done | Approve/reject/suspend/feature, subscription view, settings |
| 7 | Public Website & Map | ✅ Done | Homepage, providers list, provider profile, telehealth section |
| 8 | Search & Filtering | ✅ Done | Search + filter logic in PublicController, API for map |
| 9 | Subscription System | ✅ Done | Trial auto-created on register; expiry command scheduled |
| 10 | SEO, Notifications & Polish | ✅ Done | Meta tags, smoke test passing |

**ALL PHASE 1 MILESTONES COMPLETE ✅**

---

## Progress Log

| Date | Milestone | Action |
|------|-----------|--------|
| 2026-05-14 | M1 | Foundation — packages installed, git init, serve OK |
| 2026-05-14 | M2 | All migrations created and ran |
| 2026-05-14 | M3 | All models created, seeder ran (admin + categories) |
| 2026-05-14 | M4–M7 | Auth, all controllers, all views, map integration |
| 2026-05-14 | M8–M9 | Search/filter in controllers, subscription command scheduled |
| 2026-05-14 | M10 | SEO meta, smoke test, final commit |

---

## Current Session State

**Status**: ALL 10 MILESTONES COMPLETE — Phase 1 MVP is built and running  
**Server**: `php artisan serve` running on http://localhost:8000 ✅  
**Google Maps key**: `GOOGLE_MAP_API_KEY` in .env — all views reference this exact name  
**Mail**: `MAIL_MAILER=log` — no SMTP configured yet (owner will add credentials later)  
**Stripe**: Not configured — owner will add credentials to .env when ready  

### Phase 2 Priorities (in order)
1. **Geocoding** — Auto-convert provider address → lat/lng on profile save (Google Geocoding API, same key). Currently providers need lat/lng entered manually to appear on map.
2. **SMTP email notifications** — Owner adds MAIL_* credentials to .env; then wire up: approval notification, trial-expiry warning (7 days out), subscription-expired notification. Queue already configured (database driver).
3. **Stripe subscription billing** — Owner adds STRIPE_KEY/STRIPE_SECRET; integrate Laravel Cashier for solo/company plan billing. Subscription model already has plan_type, status, ends_at columns ready.
4. **Provider analytics** — Profile view counter (simple DB increment), basic engagement stats on provider dashboard.
5. **Geocoding on registration** — Auto-populate lat/lng when provider saves suburb/postcode so map pins appear immediately.

### Admin Credentials
- Email: `admin@kidshealthhub.com.au`
- Password: `Admin@12345`

### Key Commands
```bash
cd kids-health-hub
php artisan serve           # Start dev server
php artisan db:seed         # Re-seed admin + categories
php artisan subscriptions:expire  # Expire subscriptions
php artisan migrate:fresh --seed  # Full reset
npm run dev                 # Vite dev server
npm run build               # Build assets
```

### Key Decisions Made
- SQLite retained (suits MVP)
- Breeze (Blade) for auth; TailwindCSS v3
- Spatie Laravel Permission for roles (admin/provider)
- Provider dashboard at `/provider/dashboard` (avoids route conflict)
- Google Maps JS API with custom circular markers (green=available, blue=unavailable)
- Free trial = 3 months, created automatically on provider registration
- `subscriptions:expire` artisan command scheduled daily via bootstrap/app.php
- Slug auto-generated from business_name on registration

### File Structure
```
app/
  Console/Commands/ExpireSubscriptions.php
  Http/Controllers/
    Admin/  — AdminDashboard, AdminProvider, AdminSubscription
    Provider/ — ProviderDashboard, ProviderProfile
    Auth/  — Breeze (RegisteredUserController customized for provider role + trial)
    PublicController.php — homepage, providers list, profile, telehealth, map API
  Models/ — User, Provider, Category, Subscription, PlatformSetting
resources/views/
  layouts/ — public.blade.php, dashboard.blade.php, guest.blade.php
  public/  — home, providers, provider-profile, telehealth, partials/provider-card
  provider/ — dashboard, profile-edit
  admin/   — dashboard, providers/index+show, subscriptions/index
  auth/    — Breeze standard (register customized)
database/migrations/
  ...create_categories_table
  ...create_providers_table
  ...create_category_provider_table
  ...create_subscriptions_table
  ...create_platform_settings_table
  ...create_permission_tables (Spatie)
```

### What's NOT in Phase 1 (by design)
- Stripe/payment processing (subscription billing)
- Geocoding API (lat/lng must be entered manually or via Phase 2 integration)
- Email notifications (log driver only; configure SMTP for Phase 2)
- Appointment booking, messaging, reviews, telehealth sessions
- Parent user accounts
