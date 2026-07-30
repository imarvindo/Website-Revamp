# 🚀 Go-Live Migration Guide — SearchEngineOptimization.ae
**Target: Linux Shared Hosting (cPanel)**
Generated: July 2026

---

## 📋 What You Have

| File / Folder | What it is |
|---|---|
| `wordpress/` | Full WordPress site (theme, plugins, uploads) |
| `wordpress-mysql.sql` | Complete database (all content, SEO meta, settings) |
| `wordpress/wp-config-production.php` | Ready-to-use production config — fill in DB details |
| `wordpress/wp-content/uploads/` | All images (16 MB, 152 files) |

**WordPress Admin:**
- Username: `admin`
- Email: `admin@seo.ae`
- Password: *(set a new one in Step 7)*

**Site content:**
- 38 pages · 20 blog posts · 6 services · 4 team members · 5 case studies · 24 location pages · 9 industry pages

---

## ✅ Step-by-Step Migration

### STEP 1 — Create MySQL Database in cPanel

1. Log in to **cPanel → MySQL Databases**
2. Create a new database → e.g. `youraccount_seoae`
3. Create a new DB user → e.g. `youraccount_seoae_u` with a strong password
4. Add the user to the database → grant **ALL PRIVILEGES**
5. Note down: **DB Name**, **DB User**, **DB Password**

---

### STEP 2 — Import the Database

**Via phpMyAdmin (easiest):**
1. cPanel → phpMyAdmin → select your new database
2. Click **Import** tab
3. Upload `wordpress-mysql.sql` (3.2 MB — should be fine for most hosts)
4. Click **Go**

**Via SSH (if phpMyAdmin times out):**
```bash
mysql -u YOUR_DB_USER -p YOUR_DB_NAME < wordpress-mysql.sql
```

---

### STEP 3 — Upload WordPress Files

Upload the contents of the `wordpress/` folder to your **public_html** (or subdirectory if not root domain).

**What to upload:**
```
public_html/
├── wp-admin/
├── wp-content/
│   ├── themes/seo-ae/          ← custom theme (all your SEO work)
│   ├── plugins/
│   │   ├── advanced-custom-fields/
│   │   ├── wordpress-seo/      ← Yoast SEO
│   │   └── wpforms-lite/
│   └── uploads/                ← all images (16 MB)
├── wp-includes/
├── index.php
├── wp-login.php
└── (all other wp-*.php files)
```

**Do NOT upload:**
- `wp-content/database/` — SQLite files (server uses MySQL now)
- `wp-content/plugins/sqlite-database-integration/` — not needed on MySQL
- `router.php` — Replit dev only
- `wp-config.php` — you'll create a new one in Step 4

---

### STEP 4 — Configure wp-config.php

1. Open `wordpress/wp-config-production.php`
2. Fill in your DB details:
```php
define( 'DB_NAME',     'youraccount_seoae' );
define( 'DB_USER',     'youraccount_seoae_u' );
define( 'DB_PASSWORD', 'your_strong_password' );
define( 'DB_HOST',     'localhost' );
```
3. Replace the 8 security keys with fresh ones from:
   👉 https://api.wordpress.org/secret-key/1.1/salt/
4. Rename the file to **`wp-config.php`**
5. Upload to `public_html/`

---

### STEP 5 — Update URLs in the Database

After upload, the database still has `localhost:8000` as the site URL. Fix it:

**Via WP-CLI (SSH):**
```bash
wp search-replace 'http://localhost:8000' 'https://yourdomain.com' --all-tables
wp search-replace 'http://localhost:8000' 'https://www.yourdomain.com' --all-tables
```

**Via phpMyAdmin (no SSH):**
Run these 2 SQL queries in phpMyAdmin:
```sql
UPDATE wp_options SET option_value = 'https://yourdomain.com'
  WHERE option_name IN ('siteurl', 'home');

UPDATE wp_posts
  SET post_content = REPLACE(post_content, 'http://localhost:8000', 'https://yourdomain.com');

UPDATE wp_postmeta
  SET meta_value = REPLACE(meta_value, 'http://localhost:8000', 'https://yourdomain.com')
  WHERE meta_value LIKE '%localhost:8000%';
```

---

### STEP 6 — Set Permalinks

1. Log in to WordPress Admin (`yourdomain.com/wp-admin`)
2. Go to **Settings → Permalinks**
3. Select **Custom Structure**: `/blog/%postname%/`
4. Click **Save Changes** (this regenerates `.htaccess`)

---

### STEP 7 — Reset Admin Password

1. **Settings → Users → admin**
2. Set a new strong password
3. Change admin email to your real email
4. Update the site admin email: **Settings → General → Email**

---

### STEP 8 — Disable SQLite Plugin

The SQLite plugin is no longer needed (you're on MySQL now):
1. **Plugins → Installed Plugins**
2. Deactivate & Delete: **SQLite Database Integration**

---

### STEP 9 — SSL Certificate

1. In cPanel → **SSL/TLS → Let's Encrypt** (free)
2. Issue certificate for `yourdomain.com` and `www.yourdomain.com`
3. Enable **Force HTTPS** redirect

Or add to `.htaccess`:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

### STEP 10 — Final Checks

| Check | How |
|---|---|
| Homepage loads | Visit `https://yourdomain.com` |
| Blog post loads | Visit `https://yourdomain.com/blog/` |
| Contact form works | Submit a test enquiry |
| Images load | Check blog and services pages |
| Admin login works | `yourdomain.com/wp-admin` |
| Yoast SEO active | WP Admin → Plugins |
| No broken links | WP Admin → Yoast → Site Health |

---

## ⚙️ Server Requirements (Shared Hosting)

| Requirement | Minimum | Recommended |
|---|---|---|
| PHP | 8.0 | 8.2+ |
| MySQL / MariaDB | 5.7 / 10.3 | 8.0+ / 10.6+ |
| RAM | 256 MB | 512 MB |
| Disk | 500 MB | 2 GB |
| mod_rewrite | Required | — |

Most cPanel hosts (Hostinger, SiteGround, A2 Hosting, Namecheap) meet these by default.

---

## 🔌 Plugins Active on the Site

| Plugin | Purpose | Keep? |
|---|---|---|
| Yoast SEO | Meta titles, sitemaps, schema | ✅ Keep |
| Advanced Custom Fields (Free) | Custom post fields | ✅ Keep |
| WPForms Lite | Contact forms | ✅ Keep |
| SQLite Database Integration | Dev only | ❌ Remove |
| Akismet | Spam protection | ✅ Activate (add key) |

---

## 📧 After Go-Live — Important

1. **SMTP Email** — PHP mail() is unreliable on shared hosting. Install **WP Mail SMTP** plugin and connect to Gmail, Mailgun, or Brevo (free tier) so contact form emails arrive reliably.

2. **Google Search Console** — Submit your sitemap: `https://yourdomain.com/sitemap_index.xml`

3. **Google Analytics 4** — Add your GA4 Measurement ID to `functions.php` line ~70 (`seoae_enqueue_scripts` function).

4. **Akismet** — Activate with a free key from akismet.com to block spam enquiries.

5. **Caching** — Install **WP Super Cache** or **LiteSpeed Cache** (if host supports it) to improve page speed on live traffic.

---

## 🆘 Common Issues

**White screen / 500 error after upload:**
- Check `wp-config.php` DB credentials
- Increase PHP memory: add `define('WP_MEMORY_LIMIT','256M');` to wp-config.php

**Images not loading:**
- Run the search-replace in Step 5
- Check upload folder permissions: `chmod 755 wp-content/uploads`

**Permalink 404s:**
- Re-save permalinks: Settings → Permalinks → Save Changes
- Ensure `mod_rewrite` is enabled (contact host)

**Can't log in after migration:**
- Run in phpMyAdmin: `UPDATE wp_users SET user_pass = MD5('newpassword') WHERE user_login = 'admin';`

---

*Guide generated for SearchEngineOptimization.ae — July 2026*
