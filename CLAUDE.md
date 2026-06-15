# Kids Health Hub — Claude Reference

## Project
Healthcare provider directory for families to find child healthcare professionals. Phase 1 MVP.
Laravel app lives at: `kids-health-hub/` (this directory).

## Tech Stack
- **Backend**: Laravel 13, PHP 8.3
- **Database**: SQLite (`database/database.sqlite`)
- **Frontend**: Blade + TailwindCSS v4 via Vite
- **Auth**: Laravel Breeze (Blade stack)
- **Roles**: Spatie Laravel Permission
- **Maps**: Google Maps JS API — key in `.env` as `GOOGLE_MAP_API_KEY`
- **Mail**: Log driver (Phase 1)
- **Queue**: Database driver

## User Roles
| Role | Description |
|------|-------------|
| `admin` | Full platform control — approvals, subscriptions, featured listings, content |
| `provider` | Manages own listing only — profile, availability, telehealth, subscription |
| Public | No account needed — browse/search/view all provider listings |

## Data Model

### providers table
`id, user_id, business_name, provider_name, slug, phone, address, suburb, state, latitude, longitude, bio, profile_image, website_url, services (JSON), age_groups (JSON), funding_types (JSON), service_delivery (JSON), telehealth_available (bool), availability_status (bool), wait_time, approval_status (pending/approved/rejected), is_featured (bool), is_active (bool), created_at, updated_at`

### subscriptions table
`id, provider_id, plan_type (solo/company), status (trial/active/expired), trial_ends_at, starts_at, ends_at, payment_status, created_at, updated_at`

### categories table
`id, name, slug, created_at, updated_at`

### category_provider pivot
`category_id, provider_id`

### users table (default Laravel + role)
`id, name, email, password, email_verified_at, remember_token, created_at, updated_at`

## Business Rules
1. Provider only appears publicly when: `approval_status = approved` AND `is_active = true` AND (subscription `status = active OR trial` AND `ends_at > now`)
2. Expired subscription → `is_active = false`, listing hidden
3. Free trial = 3 months from registration (configurable via admin setting)
4. Only providers update own availability/telehealth — reflected instantly
5. Admin can override any provider visibility (`is_featured`, `is_active`, `approval_status`)
6. No chat, booking, or messaging in Phase 1
7. Families need no account to browse

## Key Routes
- `/` — Homepage (map + search + list)
- `/providers` — Provider list/search results
- `/providers/{slug}` — Public provider profile
- `/telehealth` — Telehealth providers section
- `/register` — Provider registration
- `/login` — Provider login
- `/dashboard` — Provider dashboard (auth required)
- `/admin` — Admin dashboard (admin role required)

## Feature List (Phase 1 MVP)
1. Homepage with map + search + provider list
2. Interactive Google Maps with provider markers
3. Provider search (name, suburb, postcode, service type)
4. Filters: age group, availability, telehealth, funding type, service delivery
5. Provider public profile pages (SEO-friendly slugs)
6. Telehealth section
7. Provider registration + login + password reset
8. Provider dashboard: edit profile, availability toggle, telehealth toggle, subscription view
9. Admin dashboard: approve/reject providers, manage subscriptions, feature providers, analytics
10. Subscription system: 3-month free trial, active/expired states
11. Email notifications: approval, trial expiry, subscription expiry (via log driver)
12. Availability green indicator on cards and map markers
13. Telehealth badge on cards and profiles
14. Mobile responsive (TailwindCSS)

## Acceptance Criteria
- Providers can register, complete profile, and submit for approval
- Admin can approve/reject providers
- Approved providers appear on map and list
- Search + filters update map and list simultaneously
- Provider profiles display all information correctly
- Availability and telehealth toggles reflect immediately
- Subscription trial activates on registration; expiry hides listing
- Admin can feature providers (priority placement)
- Mobile responsive on all screen sizes

## Milestones
See TRACKER.md for current status.
