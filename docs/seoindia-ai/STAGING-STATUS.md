# seoindia.ai — Staging Status

**Updated:** 2026-08-11  
**Staging URL:** https://staging.seoindia.ai/  
**Production:** https://www.seoindia.ai/ (**unchanged — do not switch DNS yet**)

---

## What was done

1. Full production backup created on BigRock:
   - Files archive (~372 MB, excludes old nested backup zips)
   - DB dump (~37 MB gzipped) — database `vasunrwt_wp821`, prefix `wpzo_`
   - Stored on server at `~/seoindia-migration-backup/`
2. Subdomain `staging.seoindia.ai` created (docroot `~/staging.seoindia.ai`)
3. Fresh MySQL DB `vasunrwt_seostg` created for staging only
4. Files + DB cloned; URLs rewritten to `https://staging.seoindia.ai`
5. Staging blocked from Google:
   - `robots.txt` → `Disallow: /`
   - WordPress `blog_public = 0` → `noindex, nofollow` meta
   - `X-Robots-Tag: noindex, nofollow` header
6. Staging admin password rotated (different from production)
7. Inventory verification: **66/66 URLs HTTP 200 + noindex**  
   Report: `artifacts/seoindia-staging-report.md`

---

## Ranking safety

| Check | Staging | Production |
|---|---|---|
| Indexable | No (`noindex`) | Yes |
| robots.txt | Disallow all | Allow + sitemap |
| Canonical host | staging.seoindia.ai | www.seoindia.ai |
| URL slugs | Same as production | Unchanged |
| Live DNS | Still points to production | Active |

---

## Access

- Staging front: https://staging.seoindia.ai/
- Staging wp-admin: https://staging.seoindia.ai/wp-admin/
- Credentials: stored on the server at  
  `~/seoindia-migration-backup/staging-access.txt`  
  (not committed to git)

---

## Next steps (before any DNS switch)

1. Manually smoke-test staging: forms, Elementor pages, images, admin
2. Optional: move the verified clone to Hostinger (needs `HOSTINGER_SSH_PASSWORD`)
3. Only after staging sign-off: point `seoindia.ai` / `www` DNS and re-run production verify
4. Immediately confirm production has **no** staging noindex / Disallow leftovers

---

## Source host facts

| Item | Value |
|---|---|
| cPanel | `sh001.bigrock.com:2083` |
| Docroot | `/home3/vasunrwt/seoindia.ai` |
| IP | `162.241.119.91` |
| Permalink | `/%postname%/` |
| Active SEO stack | Yoast SEO Premium + Local/News/Video addons |
