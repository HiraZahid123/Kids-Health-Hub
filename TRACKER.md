# Kids Health Hub — Build Tracker

## Project
Kids Health Hub — Phase 1 MVP  
Laravel 13 / PHP 8.3 / SQLite / TailwindCSS v4 / Google Maps API

---

## Milestones

| # | Milestone | Status | Notes |
|---|-----------|--------|-------|
| 1 | Foundation & Environment | 🔄 In Progress | |
| 2 | Database Migrations | ⏳ Pending | |
| 3 | Models & Relationships | ⏳ Pending | |
| 4 | Authentication & Roles | ⏳ Pending | |
| 5 | Provider Dashboard | ⏳ Pending | |
| 6 | Admin Dashboard | ⏳ Pending | |
| 7 | Public Website & Map | ⏳ Pending | |
| 8 | Search & Filtering | ⏳ Pending | |
| 9 | Subscription System | ⏳ Pending | |
| 10 | SEO, Notifications & Polish | ⏳ Pending | |

---

## Milestone Detail

### M1: Foundation & Environment
**Goal**: Get the project running with correct config, packages, and git initialized.

Tasks:
- [x] Read all docs and create CLAUDE.md
- [x] Create TRACKER.md
- [ ] Update .env (APP_NAME, MAIL_FROM)
- [ ] Install Laravel Breeze (blade stack)
- [ ] Install Spatie Laravel Permission
- [ ] Run base migrations
- [ ] Initialize git repo
- [ ] Verify `php artisan serve` works

### M2: Database Migrations
**Goal**: Create all tables needed for Phase 1.

Tables:
- [ ] categories
- [ ] providers (all profile fields, approval_status, is_featured, is_active)
- [ ] subscriptions (plan_type, status, trial_ends_at, starts_at, ends_at)
- [ ] category_provider (pivot)
- [ ] Spatie permission tables (roles, model_has_roles, etc.)

### M3: Models & Relationships
**Goal**: Eloquent models with correct relationships and scopes.

Models:
- [ ] Category
- [ ] Provider (with visibility scope)
- [ ] Subscription
- [ ] Update User model (HasRoles from Spatie)

### M4: Authentication & Roles
**Goal**: Provider and admin auth flows working.

Tasks:
- [ ] Breeze auth pages (register, login, forgot password)
- [ ] Custom provider registration (adds provider role + creates subscription trial)
- [ ] Admin seeder (admin user + admin role)
- [ ] Middleware: provider role guard, admin role guard
- [ ] Redirect after login based on role

### M5: Provider Dashboard
**Goal**: Providers can manage their listing.

Pages:
- [ ] Dashboard home (subscription status, listing status)
- [ ] Profile edit (all fields, image upload)
- [ ] Availability toggle (instant update)
- [ ] Telehealth toggle (instant update)
- [ ] Subscription status view

### M6: Admin Dashboard
**Goal**: Admin can manage all providers and platform settings.

Pages:
- [ ] Admin home (counts: pending, approved, subscriptions)
- [ ] Provider list (tabs: pending / approved / rejected / suspended)
- [ ] Provider approve/reject/suspend actions
- [ ] Provider edit (admin override)
- [ ] Subscription management
- [ ] Featured listings control
- [ ] Free trial duration setting

### M7: Public Website & Map
**Goal**: Families can discover providers on map and list.

Pages:
- [ ] Homepage (map + search bar + provider list below)
- [ ] Providers list/search page
- [ ] Individual provider profile page (SEO slug)
- [ ] Telehealth section page
- [ ] Google Maps integration (markers, popup cards)
- [ ] Availability green indicators
- [ ] Telehealth badges

### M8: Search & Filtering
**Goal**: Search by location/service/name, filter by availability/telehealth/age/funding.

Tasks:
- [ ] Search controller (name, suburb, postcode, service type)
- [ ] Filter logic (age group, availability, telehealth, funding, service delivery)
- [ ] Results update both map markers and list simultaneously
- [ ] Empty state handling
- [ ] Geocoding support (suburb → lat/lng for map centering)

### M9: Subscription System
**Goal**: Trial activation, expiry handling, notifications.

Tasks:
- [ ] Free trial activates on registration (3 months)
- [ ] Scheduled command to expire subscriptions daily
- [ ] Provider visibility auto-hides on expiry
- [ ] Email notifications (log driver): approval, trial expiry, subscription expiry

### M10: SEO, Notifications & Polish
**Goal**: Production-ready polish.

Tasks:
- [ ] SEO meta tags on provider profile pages
- [ ] Provider slug generation (business name → kebab-case, unique)
- [ ] Breadcrumbs on profile pages
- [ ] Mobile responsiveness audit
- [ ] Error/empty states on all pages
- [ ] Final `php artisan serve` smoke test

---

## Progress Log

| Date | Milestone | Action |
|------|-----------|--------|
| 2026-05-14 | M1 | Started — read all docs, created CLAUDE.md and TRACKER.md |

---

## Current Session State

**Last completed**: Created CLAUDE.md and TRACKER.md  
**Currently executing**: Milestone 1 — installing packages and configuring environment  
**Next step after this session**: Begin Milestone 2 (Database Migrations)  
**Blockers**: None  

### Decisions Made
- SQLite retained (already configured, suits MVP)
- Breeze (Blade) chosen for auth (no SPA complexity, faster build)
- Spatie Laravel Permission for role management (admin/provider)
- Google Maps JS API (key already in .env)
- TailwindCSS v4 (already in package.json)
- Provider slug = slugified business name, unique in DB
- Free trial = 3 months (configurable via admin setting stored in settings table or config)
