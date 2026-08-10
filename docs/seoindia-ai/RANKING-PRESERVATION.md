# seoindia.ai — Ranking Preservation Plan

**Goal:** Keep Google rankings stable through the Hostinger migration.  
**Method:** Change hosting only. Do not change URLs, content, or crawl signals during cutover.

Pre-migration technical baseline: [`RANKING-BASELINE.md`](./RANKING-BASELINE.md) — **66/66 URLs healthy**.

---

## What actually protects rankings

| Keep identical | Why |
|---|---|
| Every existing slug / permalink | Equity stays on the same URLs |
| `https://www.seoindia.ai` preferred host | Avoids duplicate-host dilution |
| Canonical tags → www URLs | Prevents soft duplicates |
| `robots.txt` allow + production sitemap | Keeps crawl path open |
| No sitewide / page `noindex` on live | Prevents de-indexing |
| HTTP 200 on money pages | Avoids ranking drops from soft-404s |
| Existing redirects (incl. apex→www) | Preserves historical links |
| Titles, content, internal links | Relevance signals unchanged |
| Yoast schema / XML sitemaps | Rich results + discovery continuity |
| HTTPS | Ranking + trust hygiene |

Hosting IP / server brand does **not** need to match the old host for rankings to hold.

---

## Do not do in the same release as DNS switch

- Redesign templates or rewrite service/industry copy
- “Clean up” or rename old slugs
- Change permalink settings
- Remove Yoast / Elementor / critical plugins
- Leave staging `noindex` or HTTP auth on production
- Ship a sitemap that still lists `staging.`
- Block crawling in `robots.txt` “temporarily”

Ship content/SEO growth work **after** rankings stabilize post-migration.

---

## Pre-cutover ranking checklist

- [x] Inventory all indexable URLs (`urls.txt`)
- [x] Confirm 200 + indexable + canonical on all inventory URLs
- [x] Snapshot `robots.txt` + sitemaps (`seo-artifacts/`)
- [ ] Export Google Search Console performance (28/90 days) for top queries/pages
- [ ] Note top landing pages by clicks/impressions (watch list)
- [ ] Confirm GA4 `G-164ZD0XD48` still present after clone
- [ ] Staging blocked from Google; production untouched until go-live

---

## Cutover ranking rules

1. Clone WordPress as-is to Hostinger staging.
2. Test on staging only (auth + noindex).
3. On go-live copy: restore production URLs, remove noindex/auth, restore robots/sitemap.
4. Switch DNS only when staging checks are green.
5. Immediately re-run:

```bash
./scripts/seoindia-migration/verify-site.sh \
  --base https://www.seoindia.ai \
  --urls docs/seoindia-ai/urls.txt \
  --expect-indexable \
  --report artifacts/seoindia-prod-postcutover-report.md
```

6. In Search Console (same day):
   - URL Inspection on homepage + 5 money pages
   - Resubmit `https://www.seoindia.ai/sitemap_index.xml` if needed
   - Watch Coverage / Page indexing for sudden spikes in excluded/noindex/not-found

---

## Post-migration ranking monitoring (14 days)

| Day | Check |
|---|---|
| 0 | All inventory URLs 200; no noindex; canonicals www; sitemap live |
| 1–3 | GSC coverage + manual queries for brand + top 10 pages |
| 7 | Compare GSC clicks/impressions vs pre-migration baseline |
| 14 | Confirm no material drop on priority URLs; then start SEO growth work |

If rankings dip because of a technical miss (noindex, wrong host, 404s): **fix that first**, don’t rewrite content.

---

## Keyword ranking data (needs access)

This repo can verify **technical ranking signals**. Absolute keyword positions need Search Console or a rank tracker.

Provide one of:

- Google Search Console access for `www.seoindia.ai`, or
- An exported GSC Performance CSV (pages + queries, last 90 days), or
- Ahrefs / SEMrush API credentials

Then we can attach a keyword watchlist and compare pre vs post cutover.

---

## Priority watchlist (money URLs)

- `/` Home
- `/ai-powered-seo-services/`
- `/seo-india-llm-seo/`
- `/seo-services-in-india/`
- `/managed-seo-solution/`
- `/enterprise-level-seo-solutions/`
- `/local-seo-for-business-growth/`
- `/healthcare-seo/`
- `/blogs/`

Full list: [`urls.txt`](./urls.txt)
