# PB Sahaja – Agent Guide (Enterprise)

## Stack
- **Laravel 12** (PHP 8.2+), **SQLite** (default), **Tailwind CSS v4** (via Vite/Breeze), **Vite 7**
- **Filament v5.6** admin panel at `/admin` — Rausch (#ff385c) primary, panel auth, resource-based CRUD
- **Breeze v2.4** (Blade stack) — frontend auth scaffold (`/login`, `/register`, `/profile`)
- **Livewire v4.3** — real-time reactive components
- **Laravel Pulse v1.7** — server monitoring dashboard with Pulse tables migrated
- **Laravel Octane v2.17** — high-performance server runtime (RoadRunner/Swoole)
- **Laravel Sanctum** — SPA/API token auth (bundled with Laravel)
- **GSAP 3** (`gsap: ^3.15.0`) — wired to `window.gsap` in `resources/js/app.js`
- **Midtrans** PHP SDK (`midtrans/midtrans-php: ^2.6`) — payment gateway

## Commands
| Command | What it does |
|---|---|
| `composer setup` | Full setup: install deps, create `.env`, key, migrate, `npm install && npm run build` |
| `composer dev` | Runs `artisan serve` + `queue:listen` + `pail logs` + `npm run dev` |
| `composer test` | `config:clear` then `artisan test` |
| `php artisan migrate --seed` | Migrate + seed (admin account only — no products) |
| `npm run dev` | Vite dev server |
| `npm run build` | Vite production build |
| `php artisan filament:upgrade` | Refresh Filament assets after updates |

## Routes (22 + Filament panels)
| Method | URI | Handler | Auth |
|---|---|---|---|
| GET | `/` | `ProductController@index` | No |
| GET | `/products/{slug}` | `ProductController@show` | No |
| POST | `/products/{product}/buy` | `ProductController@buy` | Yes |
| POST | `/midtrans/notification` | `MidtransController@notification` | No |
| GET/POST | `/login` | Breeze `AuthenticatedSessionController` | Guest |
| POST | `/logout` | Breeze | Auth |
| GET/POST | `/register` | Breeze `RegisteredUserController` | Guest |
| GET/POST | `/forgot-password` | Breeze | Guest |
| GET/POST | `/reset-password/{token}` | Breeze | Guest |
| GET/POST | `/profile` | Breeze `ProfileController` | Auth |
| GET/POST | `/admin` | Filament Panel | Filament auth |
| GET/POST | `/admin/login` | Filament auth | No |

## Filament Admin Panel
- **Path:** `/admin`
- **Login:** `/admin/login` with same credentials as Breeze
- **Color:** Rausch #ff385c (Airbnb primary)
- **Resources:** Product, User (auto-discovered from `app/Filament/Resources/`)
- **Pulse integration:** Available via Pulse config
- **Logout:** Built-in user menu dropdown

## Design System
- Source of truth: `AIRBNBDESIGN.md`
- **Primary:** `#ff385c` (Rausch) — Filament panel + frontend CTAs
- **Font:** **Inter** (Filament ships with Inter, Breeze uses Inter CDN)
- **Shape:** `rounded-lg` (8px) buttons, `rounded-[14px]` cards, `rounded-full` pills
- **Shadow tier:** `rgba(0,0,0,0.02) 0 0 0 1px, rgba(0,0,0,0.04) 0 2px 6px, rgba(0,0,0,0.1) 0 4px 8px`

## View Files
| View | Source |
|---|---|
| `welcome.blade.php` | Product catalog — Breeze layout (needs GSAP cinematic overhaul) |
| `products/show.blade.php` | Product detail — SVG brand stencils, GSAP 3D, Midtrans buy |
| `auth/login.blade.php` | Breeze default (clean Airbnb tailwind) |
| `dashboard.blade.php` | Breeze user dashboard |
| `admin/dashboard.blade.php` | Legacy — no longer used (Filament handles admin) |
| `admin/products/create/edit.blade.php` | Legacy — no longer used (Filament handles CRUD) |

## Models & Migration Notes
- `Product` — auto-slug on create + update, orderItems relationship
- `Order` — linked to `user_id`, stores `midtrans_order_id`, `payment_status`, `snap_token`
- `OrderItem` — product_id, quantity, custom options
- `StringingOption` — nama_senar, warna_senar, harga_tambahan, keterangan
- Pulse tables migrated (`pulse_entries`, `pulse_aggregates`, `pulse_values`)
- Filament cache tables already present

## Admin Credentials
- **Email:** `admin@pbsahaja.com`
- **Password:** `password123`
- **Login paths:** `/login` (Breeze) or `/admin/login` (Filament)

## PHP Configuration
- **ext-intl:** Enabled in `C:\xampp\php\php.ini` (required by Filament v5)
- **PHP 8.2.12** with ZTS enabled

## Gotchas
- `.env` needs `SESSION_DRIVER=database`, `CACHE_STORE=database`, `QUEUE_CONNECTION=database`
- Filament's `bootstrap/providers.php` auto-registered `AdminPanelProvider`
- Pulse dashboard route uses Pulse middleware — see `config/pulse.php`
- Octane requires RoadRunner or Swoole binary to run (`php artisan octane:start`)
- Legacy `admin/products/form.blade.php` and admin views are orphaned — Filament replaces all
- `AuthController` is orphaned — Breeze's auth controllers handle login/register now
- For Midtrans sandbox, set `MIDTRANS_SERVER_KEY` and `MIDTRANS_CLIENT_KEY` in `.env`
- GSAP CDN still loaded on show page as fallback alongside NPM build
