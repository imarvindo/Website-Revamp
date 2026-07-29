# SearchEngineOptimization.ae — cPanel Deployment Guide

## Overview
This WordPress site uses **SQLite** for local development on Replit.  
On cPanel/Linux shared hosting it needs **MySQL**. Follow these steps exactly.

---

## Step 1 — Export the Database (run in Replit)

```bash
php wp-cli.phar --path=wordpress eval-file wordpress/export-mysql.php 2>/dev/null
```
This creates **`mysql-export.sql`** in the workspace root.

---

## Step 2 — Prepare cPanel

1. Log into your cPanel
2. Go to **MySQL Databases**
3. Create a new database: e.g. `cpanelusername_seoae`
4. Create a new user with a strong password
5. Add the user to the database with **ALL PRIVILEGES**
6. Note down: Database Name, Username, Password

---

## Step 3 — Upload Files

1. Compress the `wordpress/` folder (excluding `wp-content/database/` and `wp-content/plugins/sqlite-database-integration/`)
2. Upload to `public_html/` via **cPanel File Manager** or FTP
3. Extract the archive

**Files to EXCLUDE from upload:**
```
wp-content/database/           ← SQLite database files (not needed)
wp-content/plugins/sqlite-database-integration/  ← SQLite plugin
wp-content/mu-plugins/db.php   ← SQLite MU plugin dropin
export-mysql.php               ← Dev utility only
seed-*.php                     ← Dev seed scripts
DEPLOYMENT.md                  ← This file
```

---

## Step 4 — Configure wp-config.php

1. Delete the existing `wp-config.php`
2. Rename `wp-config-production.php` → `wp-config.php`
3. Edit it with your MySQL credentials:

```php
define( 'DB_NAME',     'cpanelusername_seoae' );
define( 'DB_USER',     'cpanelusername_seoae' );
define( 'DB_PASSWORD', 'your_strong_password' );
define( 'DB_HOST',     'localhost' );
define( 'WP_HOME',    'https://yourdomain.com' );
define( 'WP_SITEURL', 'https://yourdomain.com' );
```

4. Get fresh security salts from: https://api.wordpress.org/secret-key/1.1/salt/
5. Replace the `REPLACE_WITH_FRESH_SALT_*` values

---

## Step 5 — Import the Database

1. Open **phpMyAdmin** in cPanel
2. Select your new database
3. Click **Import** tab
4. Upload `mysql-export.sql`
5. Click **Go**

If the file is too large (>50MB), use SSH:
```bash
mysql -u cpanelusername -p cpanelusername_seoae < mysql-export.sql
```

---

## Step 6 — Update Site URL in Database

After import, run these SQL queries in phpMyAdmin to update the URL:

```sql
UPDATE wp_options SET option_value = 'https://yourdomain.com'
WHERE option_name = 'siteurl';

UPDATE wp_options SET option_value = 'https://yourdomain.com'
WHERE option_name = 'home';
```

Or use WP-CLI if SSH access is available:
```bash
wp option update siteurl 'https://yourdomain.com'
wp option update home 'https://yourdomain.com'
```

---

## Step 7 — Activate Plugins

In WordPress Admin → Plugins, ensure these are active:
- ✅ Advanced Custom Fields (ACF Free)
- ✅ Yoast SEO
- ✅ WPForms Lite
- ✅ Akismet Anti-Spam
- ❌ SQLite Database Integration → DEACTIVATE and DELETE

---

## Step 8 — Final Checks

| Check | How |
|-------|-----|
| Permalinks working | Admin → Settings → Permalinks → Save (regenerates .htaccess) |
| Images loading | Check wp-content/uploads permissions (755 for dirs, 644 for files) |
| Contact form | Admin → WPForms → verify form exists and is embedded |
| Yoast SEO | Admin → SEO → First-time configuration wizard |
| Admin login | /wp-admin/ → admin / (change password immediately!) |
| SSL active | Enable HTTPS redirect in .htaccess (uncomment the RewriteRule) |

---

## Required PHP Extensions (all standard on cPanel)
- `mysqli` or `pdo_mysql`
- `curl`
- `mbstring`
- `xml` / `xmlreader` / `xmlwriter`
- `gd` or `imagick`
- `zip`
- `intl`
- `exif`

## Minimum Requirements
- PHP 7.4+ (8.0+ recommended)
- MySQL 5.7+ or MariaDB 10.3+
- Apache 2.4+ with mod_rewrite enabled

---

## Common cPanel Issues & Fixes

**Permalinks show 404:**
→ Go to Settings → Permalinks → click Save Changes (regenerates .htaccess)
→ If still broken: Contact host to enable `mod_rewrite` / `AllowOverride All`

**Images not loading:**
```bash
find wp-content/uploads -type d -exec chmod 755 {} \;
find wp-content/uploads -type f -exec chmod 644 {} \;
```

**WordPress admin shows blank white page:**
→ Enable `WP_DEBUG` temporarily → check `wp-content/debug.log`
→ Usually a plugin conflict — deactivate all, reactivate one by one

**Too large SQL import:**
→ Split with `split -l 10000 mysql-export.sql chunk_`
→ Import each chunk separately

---

*Generated: July 2026 | SearchEngineOptimization.ae*
