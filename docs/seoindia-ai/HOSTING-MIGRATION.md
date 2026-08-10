# seoindia.ai — SEO-Safe Hosting Migration Playbook

**Live site:** https://www.seoindia.ai/  
**Stack:** WordPress (Apache, LiteSpeed cache headers observed)  
**Theme:** Finix + Elementor / Elementor Pro  
**SEO:** Yoast SEO Premium  
**Approach:** Clone → test on staging → DNS switch (not direct production edits)

---

## Principle

Hosting changes alone do **not** remove Google rankings.

Rankings are at risk when migration changes:

- URL slugs / permalink structure
- Redirects (missing, wrong, or chains)
- Canonical tags
- `robots.txt` / accidental `noindex`
- XML sitemaps
- Content or soft-404 / wrong status codes
- HTTPS / mixed-content failures

**Do not point `seoindia.ai` / `www.seoindia.ai` at the new host until staging is fully verified.**

---

## Current production snapshot (2026-08-10)

| Item | Value |
|---|---|
| Preferred host | `www.seoindia.ai` (`seoindia.ai` → 301 to www) |
| Canonical home | `https://www.seoindia.ai/` |
| robots.txt | Allows all; sitemap → `https://www.seoindia.ai/sitemap_index.xml` |
| Sitemap children | posts, pages, categories, tags, author, geo |
| Indexable content URLs | See [`urls.txt`](./urls.txt) / [`url-inventory.md`](./url-inventory.md) |
| Key plugins (public) | Elementor, Elementor Pro, Contact Form 7, Google Site Kit, RevSlider, Finix Core |
| Analytics | GA4 `G-164ZD0XD48` |
| Search Console verify | meta `google-site-verification` present |

URL buckets to preserve:

- SEO service pages (e.g. `/ai-powered-seo-services/`, `/managed-seo-solution/`)
- Industry pages (e.g. `/healthcare-seo/`, `/dental-practice-seo/`)
- AI SEO / LLM pages (e.g. `/seo-india-llm-seo/`, `/seo-for-chatgpt-search/`)
- Location pages (e.g. `/virginia/`, `/new-jersey/`, `/washington-dc/`)
- Blog / resources under post permalinks + `/blogs/`
- Taxonomy: `/category/*`, `/tag/*`

---

## Phase 0 — Complete backup (before anything else)

Take a full backup of production and store it offline / on the current host:

1. **WordPress files** — full document root (not only `wp-content`)
2. **Database** — full MySQL/MariaDB dump (`mysqldump` or host backup tool)
3. **`wp-content/`** — themes, plugins, uploads, cache (exclude huge cache dirs if needed, but keep uploads)
4. **`.htaccess`**
5. **DNS / SSL notes** — A/CNAME records, www vs non-www, certificate provider
6. **`robots.txt`** (current live copy)
7. **XML sitemaps** — download `sitemap_index.xml` and child sitemaps
8. **wp-config.php** (secrets stay out of git; keep in a secure vault)

Suggested local archive names:

```text
seoindia-ai-files-YYYYMMDD.tar.gz
seoindia-ai-db-YYYYMMDD.sql.gz
seoindia-ai-seo-artifacts-YYYYMMDD/   # robots.txt + sitemaps
```

---

## Phase 1 — Clone to new hosting (staging)

1. Provision the new account / server (PHP 8.1+ recommended, MySQL 8 / MariaDB 10.6+, `mod_rewrite` or LiteSpeed equivalent).
2. Create an empty database + user with full privileges.
3. Upload WordPress files; import the database.
4. Point staging vhost at the clone, e.g.:
   - `https://staging.seoindia.ai` (preferred), or
   - a temporary host URL from the provider
5. Update only staging site URL settings (not production):

```bash
wp search-replace 'https://www.seoindia.ai' 'https://staging.seoindia.ai' --all-tables --precise
wp search-replace 'https://seoindia.ai' 'https://staging.seoindia.ai' --all-tables --precise
wp rewrite flush
wp cache flush
```

6. **Keep the same WordPress installation** (same theme, plugins, content).
7. **Do not change URLs/slugs** “while you’re here.”
8. **Keep the same permalink structure** (re-save Permalinks once so rewrite rules regenerate).
9. Re-issue SSL for the staging hostname only.

---

## Phase 2 — Block staging from Google

Staging must not be indexed.

Pick at least one (preferably two):

| Control | How |
|---|---|
| HTTP auth | cPanel Directory Privacy / server basic auth on staging vhost |
| Disallow robots | Staging `robots.txt`: `User-agent: *` / `Disallow: /` |
| noindex | Yoast → site-wide noindex **on staging only**, or `Blog public` = discourage search engines |
| IP allowlist | Optional extra lock |

Confirm staging HTML contains `noindex` (or is auth-gated) and is **not** linked from production.

---

## Phase 3 — Test everything on staging

Run the checker against staging (map production URLs to the staging host):

```bash
./scripts/seoindia-migration/verify-site.sh \
  --base https://staging.seoindia.ai \
  --urls docs/seoindia-ai/urls.txt \
  --expect-noindex \
  --report artifacts/seoindia-staging-report.md
```

Manual / scripted checklist:

| Area | Pass criteria |
|---|---|
| Important URLs | HTTP 200 (or intentional 301 within same path policy) |
| Images | Media loads; no mass 404 under `/wp-content/uploads/` |
| CSS / JS | Theme + Elementor + RevSlider assets load |
| Contact forms | Contact Form 7 submits; email/SMTP works |
| Internal links | No widespread absolute links still pointing at old host incorrectly for staging tests |
| Canonical tags | Present; on staging may point to staging or be noindexed — either OK if not indexed |
| robots.txt | Staging blocks crawlers |
| XML sitemap | Generates; paths match inventory (host differs) |
| Schema | Yoast graph present; Organization/WebPage intact |
| Redirects | Existing redirect rules from `.htaccess` / SEO plugin still work |
| wp-admin | Login, Elementor edit, media library |
| Plugins | Elementor Pro license may need staging domain authorization |
| Tracking | GA / Site Kit either disabled on staging or using a test property |
| Page speed | Roughly comparable TTFB/LCP; caching plugin configured for new host |

Fix issues on staging only. Re-run the script until green.

---

## Phase 4 — DNS switch (go-live)

Only after staging is confirmed:

1. Lower TTL ahead of cutover (e.g. 300s) if you control DNS.
2. Export a **fresh** production backup again immediately before cutover.
3. On the **production-bound** copy of the site on the new host, set URLs back to live:

```bash
wp search-replace 'https://staging.seoindia.ai' 'https://www.seoindia.ai' --all-tables --precise
wp option update home 'https://www.seoindia.ai'
wp option update siteurl 'https://www.seoindia.ai'
wp rewrite flush
wp cache flush
```

4. Remove staging-only protections from the **live** copy:
   - Remove HTTP auth
   - Restore production `robots.txt` (allow + sitemap)
   - Ensure **Settings → Reading** does **not** discourage indexing
   - Ensure Yoast is **not** site-wide noindex
5. Point DNS:
   - `seoindia.ai` and `www.seoindia.ai` A/CNAME → new host
   - Keep apex → www 301 behavior (WordPress already redirects apex to www)
6. Issue/validate SSL for both hostnames on the new host.
7. Keep the old host online (read-only) for quick rollback until post-cutover checks pass.

---

## Phase 5 — Immediate production re-check

Within minutes of DNS propagation:

```bash
./scripts/seoindia-migration/verify-site.sh \
  --base https://www.seoindia.ai \
  --urls docs/seoindia-ai/urls.txt \
  --expect-indexable \
  --report artifacts/seoindia-prod-report.md
```

Confirm live domain has:

- [ ] Correct canonical URLs (`https://www.seoindia.ai/...`)
- [ ] Correct `robots.txt` (allow + sitemap URL)
- [ ] Correct sitemap index + children
- [ ] **No** accidental `noindex` on public pages
- [ ] HTTPS working (apex + www)
- [ ] All inventory URLs resolve correctly (200)
- [ ] GA4 / Site Kit firing
- [ ] Contact form delivery
- [ ] Search Console: inspect homepage + resubmit sitemap if needed

---

## Rollback

If production is broken after DNS switch:

1. Point DNS back to the previous host (still online with last known-good files/DB).
2. Do not “fix forward” under pressure by mass-editing slugs or robots.
3. Diff staging vs last backup; repair on staging; schedule a second cutover.

---

## What not to do during this migration

- Redesign or rewrite content in the same change window
- Change permalink settings (e.g. plain ↔ post name)
- Bulk-rename slugs / “clean up” old URLs
- Leave staging `noindex` or auth on the live vhost
- Ship a sitemap that still lists `staging.`
- Delete plugins “to simplify” before cutover (especially Elementor Pro, Yoast, CF7)

Content/SEO improvements belong in a **separate** release after hosting is stable.

---

## Related files in this repo

| Path | Purpose |
|---|---|
| `docs/seoindia-ai/url-inventory.md` | Human-readable inventory by content type |
| `docs/seoindia-ai/urls.txt` | Flat list for automated checks |
| `scripts/seoindia-migration/verify-site.sh` | Status / robots / canonical / noindex checks |
| `scripts/seoindia-migration/fetch-seo-artifacts.sh` | Download live robots + sitemaps for backup |
| `HOSTING-MIGRATION-GUIDE.md` | Separate guide for SearchEngineOptimization.ae (different site) |

---

*Playbook aligned to clone → test → DNS switch for seoindia.ai.*
