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
| 10 | SEO, Notifications & Polish | 🔄 In Progress | |

---

## Milestone Detail

### M10: SEO, Notifications & Polish
Tasks:
- [ ] SEO meta tags on provider profile pages (title, description)
- [ ] Str::limit in Blade for meta_description
- [ ] Add `use Illuminate\Support\Str;` to provider-profile view
- [ ] Verify Breeze guest layout matches branding
- [ ] Test registration → approval → visibility flow end-to-end
- [ ] Test admin login and dashboard
- [ ] Final `php artisan serve` smoke test
- [ ] Git commit

---

## Progress Log

| Date | Milestone | Action |
|------|-----------|--------|
| 2026-05-14 | M1 | Foundation — packages installed, git init, serve OK |
| 2026-05-14 | M2 | All migrations created and ran |
| 2026-05-14 | M3 | All models created, seeder ran (admin + categories) |
| 2026-05-14 | M4–M7 | Auth, all controllers, all views, map integration |
| 2026-05-14 | M8–M9 | Search/filter in controllers, subscription command scheduled |

---

## Current Session State

**Last completed**: M4–M9 committed  
**Currently executing**: M10 — Final SEO polish and smoke test  
**Blockers**: None  

### Key Decisions Made
- SQLite retained (suits MVP)
- Breeze (Blade) for auth
- Spatie Laravel Permission for roles (admin/provider)
- Provider dashboard at `/provider/dashboard` (avoids route conflict with `/dashboard` redirect)
- Google Maps JS API with custom circular markers (green=available, blue=unavailable)
- Free trial = 3 months, created automatically on provider registration
- `subscriptions:expire` artisan command scheduled daily via bootstrap/app.php
- Admin user: admin@kidshealthhub.com.au / Admin@12345

### File Structure
```
app/
  Console/Commands/ExpireSubscriptions.php
  Http/Controllers/
    Admin/ — AdminDashboard, AdminProvider, AdminSubscription
    Provider/ — ProviderDashboard, ProviderProfile
    Auth/ — Breeze (customized RegisteredUserController)
    PublicController.php
  Models/ — User, Provider, Category, Subscription, PlatformSetting
resources/views/
  layouts/ — public.blade.php, dashboard.blade.php, guest.blade.php, app.blade.php
  public/ — home, providers, provider-profile, telehealth + partials/provider-card
  provider/ — dashboard, profile-edit
  admin/ — dashboard, providers/index+show, subscriptions/index
  auth/ — Breeze standard
```
