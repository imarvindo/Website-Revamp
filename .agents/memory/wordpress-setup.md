---
name: WordPress Setup
description: Infrastructure, install details, credentials, and content inventory for the WordPress site running alongside the React SPA.
---

## Location & Runtime
- WordPress directory: `/home/runner/workspace/wordpress/`
- WP-CLI: `/home/runner/workspace/wp-cli.phar`
- PHP built-in server on port 8000 via workflow "WordPress PHP Server"
- Command: `php -S 0.0.0.0:8000 -t /home/runner/workspace/wordpress /home/runner/workspace/wordpress/router.php`
- Database: SQLite (via official sqlite-database-integration plugin at `wp-content/database/.ht.sqlite`)

## WordPress Credentials
- Admin user: `admin`
- Admin email: `admin@seo.ae`
- Admin password: stored in Replit (not in memory) — ask user if lost, then reset via WP-CLI

## URL Detection (critical — Replit-specific quirk)
- `wp-config.php` priority chain: WP-CLI env → `REPLIT_DOMAINS` env var → `HTTP_X_FORWARDED_HOST` → `HTTP_HOST`
- **MUST use `REPLIT_DOMAINS`** in Replit dev. Vite proxy uses `changeOrigin: true` which rewrites `Host` to `localhost:8000` — so `HTTP_HOST` is always wrong in dev.
- When `REPLIT_DOMAINS` branch runs, also set `$_SERVER['HTTPS'] = 'on'` so WordPress generates `https://` asset URLs (not `http://`).
- `REPLIT_DOMAINS` PHP-accessible via `getenv('REPLIT_DOMAINS')` — confirmed working in both CLI and web-server contexts.

## Replit Preview Fixes (apply to every fresh environment)
- `X-Frame-Options: SAMEORIGIN` removed from `router.php` + WP core hook `send_frame_options_header` unhooked in `functions.php` — Replit preview is an iframe, SAMEORIGIN blocks it. Apache `.htaccess` re-adds it on production.
- CSP in `router.php` dynamically adds `https://{REPLIT_DOMAINS}` to `script-src`, `style-src`, `font-src`, `connect-src` — needed because assets are served from the public Replit domain.
- `xfwd: true` added to all Vite proxy entries — forwards `X-Forwarded-Host` / `X-Forwarded-Proto` to WordPress.

**Why:** Vite proxy is the only HTTP layer between Replit's public HTTPS proxy and WordPress's HTTP-only built-in server. Without these fixes WordPress generates wrong URLs and the iframe is blocked.

## Active Plugins
- `advanced-custom-fields` — ACF field groups for all CPTs
- `sqlite-database-integration` — enables SQLite mode
- `wordpress-seo` — Yoast SEO
- `wpforms-lite` — contact forms

## Theme
- `seo-ae` at `wp-content/themes/seo-ae/`
- Outfit font, cyan `#16B1D4` primary, dark navy `#101A6A` secondary

## Content Inventory (as of install)
- **Pages (8)**: Home (ID 5, front page), About (ID 6, template: page-about.php), Services (ID 7, template: page-services.php), Contact (ID 8, template: page-contact.php), Careers (ID 9, template: page-careers.php), Blog (ID 10, posts page), Portfolio (ID 11), Case Studies (ID 12)
- **Services (6)**: SEO (13), AI Search (14), PPC (15), Social Media (16), Web Design (17), Web Dev (18) — all have `service_icon` and `tagline` ACF fields set
- **Blog posts (15)**: IDs 19-21, 28-37, 50-51 — UAE-relevant SEO topics, 1000-2000 words each
- **Testimonials (4)**: IDs 22-25 with reviewer_name, reviewer_company, rating, result_metric meta
- **Case Studies (2)**: IDs 26-27 with client_name, cs_industry, cs_duration meta
- **Menus**: Primary (ID 2 → location "primary"), Footer Services (4 → footer-col-1), Footer Company (5 → footer-col-2), Footer Resources (6 → footer-col-3)

## Template Files Written
- `front-page.php`, `single.php`, `page.php`, `single-service.php`, `archive.php`, `404.php`
- `page-contact.php`, `page-about.php`, `page-services.php`, `page-careers.php`
- `single-case_study.php`, `single-portfolio_item.php`
- **Missing**: `page-dubai.php` (Dubai location landing page)

## WP-CLI Common Commands
```bash
WP="php /home/runner/workspace/wp-cli.phar --path=/home/runner/workspace/wordpress --allow-root"
$WP post list --post_type=service
$WP rewrite flush
$WP cache flush
```

## Production Migration
- User will deploy to their own server (cPanel/MySQL)
- Run: `$WP search-replace 'http://localhost:8000' 'https://yourdomain.com'` after MySQL import
- SQLite → MySQL: export with `$WP db export`, import to MySQL after updating wp-config.php

**Why:** SQLite is dev-only; the wp-config already has dynamic URL detection so no URL hardcoding issues on migration.
