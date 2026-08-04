# Phase 5 — Page Specifications

**Product:** ForgeLink  
**Document:** 05 — Page Specifications  
**Version:** 1.0.0  

Each page includes: Purpose · Sections · Components · API Calls · Permissions · SEO · Validation Rules.

---

## Conventions

| Item | Standard |
|------|----------|
| Auth header | `Authorization: Bearer <access_token>` unless cookie mode |
| Public GETs | Cacheable where noted |
| Forms | Client Zod + server FormRequest parity |
| Errors | Inline field errors + toast for system errors |
| SEO defaults | Title ≤ 60 chars; meta description 140–160 |

---

## A. Marketing & Public Pages

### A1. Homepage `/`

**Purpose:** Convert visitors into searchers/project posters; communicate brand and trust.  
**Permissions:** Public  

**Sections**
1. Full-bleed hero with brand-forward ForgeLink wordmark, one headline, one supporting sentence, CTA group (Find Companies / Post Project)
2. Trust strip (companies count, countries, verified reviews) — below first viewport
3. AI search entry
4. Popular services / technologies
5. Featured / top matched companies (labeled)
6. How it works (3 steps)
7. Buyer & company value props (separate)
8. Testimonials / review highlights
9. Blog highlights
10. Final CTA

**Components:** `Hero`, `AISearchBox`, `TaxonomyPills`, `CompanyCard`, `Steps`, `CTASection`, `Footer`  

**API Calls**
- `GET /api/v1/home/bootstrap`
- `GET /api/v1/search/autocomplete?q=`
- `GET /api/v1/companies?featured=1&limit=8`
- `GET /api/v1/blog/posts?limit=3`

**SEO:** Indexable; Organization + WebSite SearchAction schema; OG image brand hero  
**Validation:** AI search query 2–500 chars  

---

### A2. About `/about`

**Purpose:** Mission, team credibility, differentiation.  
**Sections:** Mission, story, principles, stats, careers CTA, contact CTA  
**APIs:** `GET /api/v1/cms/pages/about`  
**SEO:** Article/AboutPage meta; indexable  

---

### A3. How It Works `/how-it-works`

**Purpose:** Explain buyer & company journeys.  
**Sections:** Tabbed Buyer/Company flows, FAQs, CTAs  
**APIs:** CMS page + `GET /api/v1/faqs?topic=how-it-works`  
**SEO:** FAQ schema  

---

### A4. Pricing `/pricing` & `/pricing/compare`

**Purpose:** Convert companies to paid plans.  
**Sections:** Plan cards, feature matrix, FAQ, enterprise contact  
**APIs:** `GET /api/v1/billing/plans`  
**Permissions:** Public view; checkout requires `agency_owner`  
**SEO:** Indexable; Product/Offer schema optional  
**Validation:** Plan code must be active  

---

### A5. Contact `/contact`

**Purpose:** Sales/support intake.  
**Sections:** Form, offices, SLA expectations  
**APIs:** `POST /api/v1/support/contact`  
**Validation:** name, email, topic enum, message 20–5000, CAPTCHA  

---

### A6. FAQ `/faq`

**Purpose:** Deflect support; SEO.  
**APIs:** `GET /api/v1/faqs`  
**SEO:** FAQPage schema  

---

### A7. Trust `/trust` & Ranking `/ranking`

**Purpose:** Explain verification & ranking transparency.  
**APIs:** CMS  
**SEO:** Indexable; critical for trust USP  

---

### A8. Blog `/blog`, `/blog/:slug`

**Purpose:** Content marketing & SEO.  
**APIs:** `GET /api/v1/blog/posts`, `GET /api/v1/blog/posts/:slug`  
**SEO:** Article schema, OG, author, canonical, related posts internal links  

---

### A9. Legal pages `/legal/*`

**Purpose:** Compliance.  
**APIs:** CMS  
**SEO:** Indexable; last-updated date required  

---

## B. Auth Pages

### B1. Login `/login`

**Purpose:** Authenticate existing users.  
**Sections:** Email/password, Google, LinkedIn, links to register/forgot  
**APIs:** `POST /api/v1/auth/login`, OAuth redirect endpoints  
**Validation:** email format; password required  
**SEO:** `noindex`  

---

### B2. Register `/register` & `/register/company`

**Purpose:** Create client or company account.  
**Sections:** Account type selector; fields; ToS consent  
**APIs:** `POST /api/v1/auth/register`  
**Validation:** email unique; password policy; company name if company path; consent=true  
**SEO:** `noindex`  

---

### B3. Forgot / Reset / Verify / OTP / 2FA

| Page | APIs | Validation |
|------|------|------------|
| Forgot | `POST /auth/forgot-password` | email |
| Reset | `POST /auth/reset-password` | token, password, confirmation |
| Verify email | `POST /auth/verify-email` | token |
| OTP | `POST /auth/otp/verify` | code 6 digits |
| 2FA challenge | `POST /auth/2fa/verify` | TOTP 6 digits |
| 2FA setup | `POST /auth/2fa/setup`, `POST /auth/2fa/confirm` | |

**SEO:** all `noindex`  
**Permissions:** appropriate session state required  

---

## C. Discovery Pages

### C1. Search Results `/search`

**Purpose:** Primary discovery surface.  
**Permissions:** Public  

**Sections**
1. Search bar + AI toggle
2. Filter sidebar / drawer
3. Active filter chips
4. Sort control + result count
5. Results list (company cards)
6. Map toggle panel
7. Pagination / infinite load
8. Save search CTA
9. Zero-state recommendations

**Components:** `FilterPanel`, `CompanyResultCard`, `MapPanel`, `SortSelect`, `SaveSearchModal`  

**APIs**
- `GET /api/v1/search/companies`
- `GET /api/v1/search/facets`
- `POST /api/v1/saved-searches` (auth)
- `GET /api/v1/geo/countries`, `/cities`

**SEO:** Indexable only for clean canonical filter combos OR redirect to directory pages; arbitrary query URLs `noindex`  
**Validation:** page≥1; filter IDs exist; rate≤max  

---

### C2. AI Search `/ai-search`

**Purpose:** NL matching experience.  
**Sections:** Prompt box, interpreted filters, ranked results with reasons, refine controls  
**APIs:** `POST /api/v1/ai/search`  
**Permissions:** Public limited; auth expanded  
**SEO:** `noindex` (tool page) or indexable marketing shell with app behind  
**Validation:** query 5–1000 chars; language detect optional  

---

### C3. Company Profile `/companies/:slug`

**Purpose:** Convert profile views to leads/hires.  
**Permissions:** Public for published; owners see preview  

**Sections**
1. Cover + logo + name + verification badges + score
2. CTA bar: Contact, Invite to Project, Save, Compare, Share
3. Overview / description
4. Services, technologies, industries
5. Rates & min budget
6. Portfolio highlights
7. Case studies
8. Reviews + AI summary + distribution
9. Team
10. Locations + map
11. Awards & certifications
12. FAQs
13. Downloads
14. Similar companies

**APIs**
- `GET /api/v1/companies/:slug`
- `GET /api/v1/companies/:slug/portfolio`
- `GET /api/v1/companies/:slug/case-studies`
- `GET /api/v1/companies/:slug/reviews`
- `GET /api/v1/companies/:slug/faqs`
- `POST /api/v1/leads`
- `POST /api/v1/comparisons/items`

**SEO:** Indexable if published; Organization + AggregateRating + FAQ schema; canonical; OG with logo/cover  
**Validation (lead form):** see Leads API  

---

### C4. Portfolio / Case Study Subpages

**Purpose:** Deep work samples for SEO & trust.  
**APIs:** entity GETs by slug  
**SEO:** indexable; Article/CreativeWork schema where fit; breadcrumbs Company → Portfolio → Item  

---

### C5. Compare `/compare`

**Purpose:** Side-by-side evaluation.  
**Sections:** Column headers, attribute rows, CTA per column  
**APIs:** `GET /api/v1/comparisons/current`, company batch GET  
**Permissions:** Public session; auth persist  
**SEO:** `noindex`  
**Validation:** 2–4 companies  

---

### C6. Saved `/saved`

**Purpose:** Persist shortlists & searches.  
**APIs:** `GET/DELETE /saved-companies`, `GET/PUT/DELETE /saved-searches`  
**Permissions:** `client` / any auth user  
**SEO:** `noindex`  

---

### C7. Map `/map`

**Purpose:** Geo discovery.  
**APIs:** `GET /search/companies?view=map&bbox=`  
**SEO:** indexable light page + `noindex` for bbox query variants  

---

## D. Programmatic SEO Pages

### Template: Directory Hub Pages

Applies to `/directory/:country`, `/services/:service`, `/technologies/:tech`, `/industries/:industry`, and combinations.

**Purpose:** Capture search demand; list matching companies.  
**Permissions:** Public  

**Sections**
1. H1 + unique intro (CMS/AI, QA gated)
2. Breadcrumbs
3. Stats (count, avg rating)
4. Filterable company grid
5. Related links (internal linking)
6. FAQs
7. CTA Post Project / List Company

**APIs**
- `GET /api/v1/seo/pages/:type/:slug...`
- `GET /api/v1/search/companies?` prefilled filters
- `GET /api/v1/seo/pages/:id/faqs`

**SEO Requirements**
- Unique title/description
- Canonical to itself
- FAQ + ItemList + Breadcrumb schema
- Only publish if `company_count >= threshold` (config; default 5)
- Thin page auto-`noindex` or unpublish

**Validation:** slugs resolve to published taxonomy; combo exists  

---

## E. Project Marketplace Pages

### E1. Browse Projects `/projects`

**Purpose:** Providers find work.  
**Permissions:** Auth company/freelancer; clients see own via app  
**Sections:** Filters (skills, budget, country), project cards, sort  
**APIs:** `GET /api/v1/projects`  
**SEO:** `noindex`  
**Validation:** provider org active  

---

### E2. Post Project `/projects/new`

**Purpose:** Create project brief.  
**Permissions:** `client`  
**Sections:** Multi-step wizard (Doc 03)  
**APIs:** `POST /api/v1/projects`, `POST /api/v1/uploads`, `GET /taxonomies/*`  
**SEO:** `noindex`  
**Validation:** title 10–120; description ≥100; budget rules; file types allowlist; NDA boolean  

---

### E3. Project Detail `/projects/:id`

**Purpose:** View brief; submit proposal.  
**APIs:** `GET /projects/:id`, `POST /projects/:id/proposals`  
**Permissions:** Open projects visible to eligible providers; private to invitees + owner  
**SEO:** `noindex`  

---

### E4. Proposals Inbox & Compare

| Page | Purpose | APIs | Permissions |
|------|---------|------|-------------|
| `/projects/:id/proposals` | Manage proposals | `GET /projects/:id/proposals` | Project owner |
| `/projects/:id/proposals/:pid` | Proposal detail | `GET /proposals/:pid` | Owner or author org |
| `/projects/:id/compare-proposals` | Compare | `GET /projects/:id/proposals?compare=1` | Owner |
| `/projects/:id/hire` | Confirm hire | `POST /projects/:id/hire` | Owner |

**Validation (hire):** `proposal_id` must belong to project and be `submitted`/`shortlisted`  

---

## F. Messaging Pages

### F1. Inbox `/messages` & Thread `/messages/:threadId`

**Purpose:** Real-time communication.  
**Sections:** Thread list, conversation pane, composer, attachments, typing/read UI  
**APIs:** REST history + WS channel `threads.{id}`  
- `GET /api/v1/messages/threads`
- `GET /api/v1/messages/threads/:id`
- `POST /api/v1/messages/threads/:id/messages`
- `POST /api/v1/messages/threads/:id/read`

**Permissions:** Thread participants only (moderators if flagged)  
**SEO:** `noindex`  
**Validation:** body ≤10k; attachment mime/size; rate limit  

---

## G. Client Workspace

### G1. Dashboard `/app`

**Purpose:** Snapshot of projects, shortlist, messages, recommended companies.  
**APIs:** `GET /api/v1/client/dashboard`  
**Permissions:** `client`  
**SEO:** `noindex`  

### G2. Shortlist / Projects / Reviews / Settings / Security / Notifications

| Page | Key APIs | Validation highlights |
|------|----------|----------------------|
| Shortlist | saved companies CRUD | max items by soft cap |
| Projects | client projects list | — |
| Reviews | pending review invitations | rating 1–5; body length |
| Settings | `PATCH /users/me` | profile fields |
| Security | password, 2FA, sessions | current password required |
| Notifications | `PATCH /users/me/notification-preferences` | boolean map |

---

## H. Company Studio Pages

### H1. Dashboard `/studio`

**Purpose:** Leads, proposals, profile score, plan usage, analytics snapshot.  
**APIs:** `GET /api/v1/studio/dashboard`  
**Permissions:** company membership  
**SEO:** `noindex`  

### H2. Profile & Media Editors

| Page | Purpose | APIs | Validation |
|------|---------|------|------------|
| Profile | Edit core fields | `PATCH /studio/company` | field lengths; URL https |
| Media | Logo/cover/gallery/videos | `POST /uploads`, reorder APIs | mime, size, plan limits |
| Portfolio | CRUD items | `/studio/portfolio` | required cover+title |
| Case studies | CRUD | `/studio/case-studies` | results metrics optional JSON |
| Services | taxonomy attach | `/studio/taxonomies` | max per plan |
| Team | employees CRUD | `/studio/employees` | — |
| Locations | offices CRUD | `/studio/locations` | country required; geocode |
| FAQs | CRUD + AI gen | `/studio/faqs`, `POST /ai/faqs` | Q/A required |
| Downloads | file assets | `/studio/downloads` | pdf/docx allowlist |

### H3. Leads `/studio/leads`

**Purpose:** Manage inbound leads + AI scores.  
**APIs:** `GET/PATCH /studio/leads/:id`  
**Permissions:** sales+ roles  
**Validation:** status enum transitions  

### H4. Proposals `/studio/proposals`

**Purpose:** Track proposal pipeline.  
**APIs:** list/detail/withdraw  
**Validation:** withdraw only if not accepted  

### H5. Reviews `/studio/reviews`

**Purpose:** Reply, request reviews, view AI themes.  
**APIs:** reply, invite  
**Validation:** reply ≤2k chars  

### H6. AI `/studio/ai`

**Purpose:** Copilot hub (description, SEO meta, proposal, FAQ).  
**APIs:** `/api/v1/ai/*`  
**Permissions:** plan credits  
**Validation:** credit balance > 0; output approval required to publish  

### H7. Analytics `/studio/analytics`

**Purpose:** Impressions, CTR, leads, proposal win rate.  
**APIs:** `GET /studio/analytics?range=`  
**Permissions:** admin/owner/viewer  

### H8. Verification `/studio/verification`

**Purpose:** Submit docs; track status.  
**APIs:** `POST /studio/verification`  
**Validation:** required docs per country config; file scan  

### H9. Billing `/studio/billing` & Featured `/studio/featured`

**APIs:** Stripe/Razorpay checkout sessions, portal, invoices, featured purchase  
**Permissions:** `owner` (billing)  
**Validation:** plan/coupon validity  

### H10. Team Access `/studio/team-access`

**APIs:** invites, role changes, revoke  
**Validation:** email; role enum; seat limits  

### H11. Activity `/studio/activity`

**APIs:** `GET /studio/activity`  
**Permissions:** admin/owner  

---

## I. Admin Pages

All Admin pages: **Permissions** platform roles; **SEO** `noindex, nofollow`.

| Page | Purpose | Core APIs |
|------|---------|-----------|
| `/admin` | KPI overview | `GET /admin/dashboard` |
| `/admin/users` | Manage users | users CRUD/suspend |
| `/admin/companies` | Manage companies | search, edit, suspend |
| `/admin/companies/verification` | Verify queue | approve/reject |
| `/admin/projects` | Moderate projects | remove/approve |
| `/admin/reviews` | Moderate reviews | hide/remove |
| `/admin/reports` | Abuse reports | resolve |
| `/admin/cms/pages` | CMS | pages CRUD |
| `/admin/cms/blog` | Blog | posts CRUD |
| `/admin/seo` | Meta/canonical/templates | seo CRUD |
| `/admin/seo/redirects` | 301s | redirects CRUD |
| `/admin/taxonomy` | Services/tech/etc | taxonomy CRUD |
| `/admin/subscriptions` | Manual billing ops | subscriptions |
| `/admin/coupons` | Coupons | coupons CRUD |
| `/admin/featured` | Slots inventory | featured CRUD |
| `/admin/revenue` | Finance KPIs | revenue metrics |
| `/admin/analytics` | Platform analytics | analytics |
| `/admin/emails` | Templates | templates CRUD |
| `/admin/notifications` | Broadcasts | notifications |
| `/admin/logs` | Audit logs | logs list |
| `/admin/settings` | System config | settings |
| `/admin/feature-flags` | Flags | flags CRUD |
| `/admin/ai` | Prompts & usage | ai admin |

**Validation (admin mutations):** reason code required for destructive trust actions; CSRF; 2FA preferred  

---

## J. Shared Error & System Pages

| Page | Purpose |
|------|---------|
| `/404` | Not found; helpful links |
| `/403` | Forbidden |
| `/429` | Rate limited |
| `/500` | Error |
| `/maintenance` | Maintenance mode |

SEO: `noindex`

---

## K. Page Inventory Checklist

- [x] Marketing & legal
- [x] Auth suite
- [x] Discovery & profiles
- [x] Programmatic SEO templates
- [x] Projects & proposals
- [x] Messaging
- [x] Client app
- [x] Company studio
- [x] Admin
- [x] System pages

---

*Next: [06 — Database Design](./06-database-design.md)*
