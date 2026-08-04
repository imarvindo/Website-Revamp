# Phase 4 — Complete Feature Specifications

**Product:** ForgeLink  
**Document:** 04 — Feature Specifications  
**Version:** 1.0.0  

---

## Feature Status Legend

| Status | Meaning |
|--------|---------|
| MVP | Required for production launch |
| P2 | Phase 2 |
| FUT | Future enhancement |

---

## 1. Authentication & Account Security

### 1.1 Email Login — MVP
- Email + password login
- Password rules: min 10 chars, upper, lower, number, special; breached-password check (HaveIBeenPwned k-anonymity)
- Lockout: 5 failed attempts → 15 min cooldown (progressive)
- Session: JWT access (15m) + refresh (30d) in httpOnly secure cookie or rotating refresh token store

### 1.2 Google Login — MVP
- OAuth 2.0 / OIDC
- Account linking by verified email
- Capture name, avatar, email

### 1.3 LinkedIn Login — MVP
- OAuth 2.0 for buyers & company users
- Prefer LinkedIn for B2B trust signals
- Store `oauth_identities` provider + subject

### 1.4 OTP — MVP
- Email OTP for verification & sensitive actions
- Optional SMS OTP (P2) via provider
- 6-digit, 10-minute expiry, single-use, rate-limited

### 1.5 2FA — MVP
- TOTP authenticator apps
- Backup codes (10 single-use)
- Required for `super_admin` and `moderator`
- Optional for others; encouraged for `agency_owner`

### 1.6 Forgot Password — MVP
- Email reset link (60 min)
- Invalidate prior reset tokens
- Force logout other sessions on reset (optional toggle)

### 1.7 Role Management — MVP
- Platform roles + org membership roles
- Invite members by email
- Permission checks on every privileged API

### 1.8 Profile Management — MVP
- Name, headline, avatar, timezone, locale, phone (optional)
- Notification preferences
- Connected accounts (Google/LinkedIn)

### 1.9 Notifications — MVP
- In-app notification center
- Email notifications (SES)
- Preference matrix by event type
- P2: Web push; FUT: Mobile push

### 1.10 Activity Logs — MVP
- User security activity: logins, password changes, 2FA
- Org activity: profile edits, proposal sends, member changes
- Admin audit log separate (immutable)

---

## 2. Company Profiles

### 2.1 Core Profile — MVP

| Field | Type | Validation | Notes |
|-------|------|------------|-------|
| name | string | 2–120 chars | Legal/brand name |
| slug | string | unique kebab | Auto from name; editable pre-publish |
| tagline | string | ≤160 | |
| description | rich text | ≤20k chars | AI assist |
| logo | image | PNG/JPG/WEBP ≤5MB | Square recommended |
| cover_image | image | ≤10MB | 16:9 |
| founded_year | int | 1800–current | |
| company_size | enum | 1-10, 11-50, 51-200, 201-500, 500+ | |
| hourly_rate_min | money | ≥0 | Currency ISO |
| hourly_rate_max | money | ≥ min | |
| minimum_budget | money | ≥0 | Project min |
| website | url | https | Domain used in verification |
| email_public | email | optional | |
| phone_public | string | optional | |
| languages[] | taxonomy | | |
| social_links | json | allowlisted networks | |
| status | enum | draft/published/suspended | |

### 2.2 Gallery — MVP
- Ordered images, captions, alt text
- Max by plan (Free 6, Starter 15, Pro 50, Ent unlimited soft-cap 200)

### 2.3 Portfolio — MVP
- Title, slug, summary, cover, gallery, URL, technologies[], industries[], year
- Visibility public/private

### 2.4 Case Studies — MVP
- Problem, solution, results (metrics), services, tech, client industry, testimonial excerpt
- SEO fields; AI outline assist

### 2.5 Videos — MVP
- YouTube/Vimeo embeds or uploaded MP4 (S3 + CDN)
- Plan limits on uploads

### 2.6 Awards — MVP
- Title, issuer, year, URL, image
- Influences ranking lightly; anti-spam moderation

### 2.7 Certifications — MVP
- Name, issuer, year, credential URL, expiry

### 2.8 Office Locations — MVP
- Label, address, city, country, lat/lng, is_hq
- Google Maps embed/autocomplete

### 2.9 Employees / Team — MVP
- Name, role, photo, LinkedIn, bio, skills, is_public
- Count contributes to size signal if verified

### 2.10 Taxonomies — MVP
- Industries[], Services[], Technologies[], Languages[]
- Admin-managed taxonomy with synonyms for search

### 2.11 Contact Form — MVP
- Creates Lead; CAPTCHA + rate limit
- Fields: name, email, company, budget range, message, attachments optional

### 2.12 Maps — MVP
- Profile map for offices; directory map clustering

### 2.13 Reviews Module Embed — MVP
- Summary rating, distribution, AI summary, list

### 2.14 FAQs — MVP
- Q/A pairs; AI FAQ generator; FAQ schema

### 2.15 Downloads — MVP
- Brochures, media kits, capability PDFs
- Virus scan on upload; gated optional (email gate P2)

### 2.16 Completeness Score — MVP
- Weighted checklist (logo, description, 3 services, 5 techs, 2 portfolio, location, rate, etc.)
- Shown in Studio; used in ranking

---

## 3. Search System

### 3.1 Keyword Search — MVP
- Meilisearch over companies, services, tech, locations
- Typo tolerance, synonyms, ranking rules

### 3.2 AI Search — MVP
- NL query → structured intent (filters + embedding retrieval)
- Returns companies + match reasons
- Guest rate limit; auth higher limits

### 3.3 Autocomplete — MVP
- Companies, services, technologies, locations, popular queries
- Debounced; cached

### 3.4 Filters — MVP

| Filter | Type |
|--------|------|
| Country | multi |
| City | multi (depends on country) |
| Budget / min project | range |
| Hourly rate | range |
| Technology | multi |
| Industry | multi |
| Service | multi |
| Employee size | multi enum |
| Ratings | min stars |
| Verified only | boolean |
| Awards | boolean / issuer |
| Premium / featured | boolean (UI label carefully) |
| Languages | multi |
| Response time | P2 |
| Timezone overlap | P2 |

### 3.5 Sorting — MVP
- Best match (default)
- Highest rated
- Most reviews
- Newest
- Hourly rate asc/desc
- Profile completeness
- Featured first (within fair rules; must disclose)

### 3.6 Saved Searches — MVP
- Persist filters + AI query
- Email alerts when new companies match (daily digest)

### 3.7 Search Analytics — MVP
- Query logs (privacy-safe), zero-result tracking, filter usage

---

## 4. Project Marketplace

### 4.1 Project Posting — MVP
Wizard fields:
- Title, description, category/services, skills/tech
- Budget type: fixed / hourly / range / undisclosed
- Timeline / deadline
- Files (S3), NDA required toggle + template accept
- Preferred countries / remote OK
- Visibility: open marketplace / invite-only / both
- Company size preference optional

### 4.2 Proposal Submission — MVP
- Cover letter, approach, timeline, bid amount, milestones optional, attachments
- AI Proposal Writer assist
- Plan-based monthly proposal limits for Free tier

### 4.3 Proposal Comparison — MVP
- Side-by-side: price, timeline, skills overlap, rating, verification, AI fit score

### 4.4 Project Status — MVP
States per Doc 03; transitions validated server-side

### 4.5 Hiring Workflow — MVP
- Shortlist → hire → decline others → thread → review request

### 4.6 NDA — MVP
- Checkbox accept platform NDA or upload custom
- Acceptance logged with timestamp + IP + user agent

---

## 5. Messaging

| Feature | Status | Spec |
|---------|--------|------|
| Real-time chat | MVP | WebSockets (Laravel Reverb / Soketi) |
| Attachments | MVP | Images/PDF/Docs ≤25MB; AV scan |
| Typing indicator | MVP | Ephemeral WS events |
| Read receipts | MVP | Per-message read_at |
| Notifications | MVP | In-app + email (batched) |
| Message search | P2 | Full-text in threads |
| Video calls | FUT | Integrations |

**Moderation:** report, block, auto-flag toxic patterns (AI assist P2)

---

## 6. Reviews

| Feature | Status | Notes |
|---------|--------|-------|
| Verified reviews | MVP | Hire-linked or invite token |
| Star ratings | MVP | Overall + optional dimensions: quality, communication, deadline, value |
| Review moderation | MVP | Queue + AI pre-score |
| Helpful votes | MVP | One vote per user per review |
| Report abuse | MVP | Reasons + evidence |
| Company replies | MVP | One reply; editable 24h |
| AI review summary | MVP | Regenerated on threshold changes |
| Incentivized review detection | P2 | Risk signals |

**Rules**
- Min 50 chars review body
- No doxxing / hate / competitor spam
- Companies cannot review themselves
- Edit window 1h for author; after that request moderator

---

## 7. AI Features

| Feature | Status | Input | Output | Guardrails |
|---------|--------|-------|--------|------------|
| AI Company Matching | MVP | Brief / project | Ranked companies + reasons | Ground on indexed facts only |
| AI Project Recommendation | MVP | Company profile | Suggested open projects | Plan gated |
| AI Proposal Writer | MVP | Project + company facts | Draft proposal | Must edit/approve |
| AI Company Description Generator | MVP | Profile fields | Description variants | No fabricated clients/awards |
| AI SEO Meta Generator | MVP | Page entity | title/description | Length limits |
| AI Blog Writer | P2 | Outline / keywords | Draft post | Human publish only |
| AI FAQ Generator | MVP | Profile/services | FAQ pairs | Fact-check prompt |
| AI Smart Search | MVP | NL query | Filters + results | Show interpreted filters |
| AI Review Analysis | MVP | Review corpus | Summary + themes | Aggregate only |
| AI Lead Scoring | MVP | Lead + firmographics | 0–100 + reasons | Pro+ |

### AI Platform Requirements
- Provider abstraction (OpenAI-compatible + fallback)
- Prompt templates versioned in DB/config
- Token usage metering per org
- PII minimization in prompts
- Content safety filters
- Full generation history for audit (`ai_generations`)

---

## 8. Subscription System

### 8.1 Plans — MVP

| Capability | Free | Starter | Professional | Enterprise |
|------------|------|---------|--------------|------------|
| Price (indicative USD/mo) | $0 | $49 | $149 | Custom |
| Profile publish | ✓ | ✓ | ✓ | ✓ |
| Portfolio items | 5 | 20 | 100 | Unlimited* |
| Case studies | 1 | 5 | 25 | Unlimited* |
| Team seats | 2 | 5 | 20 | Unlimited* |
| Proposals / mo | 5 | 25 | 100 | Unlimited* |
| AI credits / mo | 10 | 100 | 500 | Custom |
| Lead inbox | ✓ | ✓ | ✓ | ✓ |
| AI lead scoring | — | Basic | ✓ | ✓ |
| Analytics | Basic | Standard | Advanced | Advanced + export |
| Featured credits / mo | 0 | 1 | 3 | Custom |
| Verification eligibility | ✓ | ✓ | ✓ | ✓ |
| SSO / SLA | — | — | — | ✓ |
| API access | — | — | Read | Full |
| Support | Email | Email | Priority | Dedicated |

\* Soft fair-use caps enforced.

### 8.2 Compare Plans — MVP
Marketing page + in-app upgrade modals with usage meters.

### 8.3 Usage Limits — MVP
Enforced in middleware; clear upgrade CTAs; never silent fail.

### 8.4 Payments — MVP
- Stripe (cards, invoices, tax where available)
- Razorpay for INR corridor
- Webhooks authoritative for entitlement sync

### 8.5 Invoices — MVP
- PDF invoices, VAT/GST fields, billing address, download history

### 8.6 Coupons — MVP
- Percent/fixed, duration, redemption limits, plan restrictions, expiry

---

## 9. Admin Panel Features

| Module | Status | Capabilities |
|--------|--------|--------------|
| Dashboard | MVP | KPIs: users, companies, projects, MRR, queues |
| User Management | MVP | Search, suspend, role assign, force logout |
| Company Verification | MVP | Queue, checklist, approve/reject |
| Project Moderation | MVP | Spam/illegal content removal |
| Review Moderation | MVP | Approve/hide/remove |
| CMS | MVP | Static pages |
| Blog | MVP | Posts, tags, authors, schedule |
| SEO | MVP | Meta defaults, per-page overrides, redirects, canonical tools |
| Analytics | MVP | Product + traffic summaries |
| Revenue | MVP | MRR, churn, plan mix |
| Subscriptions | MVP | Manual comp, extend, cancel |
| Feature Listings | MVP | Inventory slots by page type |
| Email Templates | MVP | Editable templates + variables preview |
| Notification Center | MVP | Broadcasts / system notices |
| Logs | MVP | Audit + app logs linkout |
| Reports | MVP | CSV exports; scheduled P2 |

---

## 10. SEO Requirements

### 10.1 Programmatic SEO — MVP
- Generate pages for taxonomy combinations meeting quality thresholds (min N companies, unique intro)
- Editorial templates + AI-assisted unique intros (human QA for head terms)

### 10.2 Dynamic URLs — MVP
See Doc 03 patterns; routing table driven by taxonomy

### 10.3 Schema.org — MVP
- Organization, LocalBusiness (where applicable), Service, FAQPage, Article, BreadcrumbList, AggregateRating/Review, WebSite (SearchAction)

### 10.4 Technical SEO — MVP
- Breadcrumbs on all directory/profile pages
- Canonical URLs
- Meta title/description management (CMS + AI assist)
- `robots.txt` environment-aware
- `sitemap.xml` index + partitioned sitemaps (companies, directories, blog)
- Open Graph + Twitter Cards
- Internal linking module (related services/cities/companies)
- Core Web Vitals budgets: LCP ≤ 2.5s, INP ≤ 200ms, CLS ≤ 0.1 (p75 mobile)

### 10.5 SEO Governance
- Noindex thin pages
- Duplicate company merge tools
- Redirect manager (301)
- Hreflang in P2 with locales

---

## 11. Cross-Cutting Features

| Feature | Status |
|---------|--------|
| Multi-currency display | MVP (USD default + convert display) |
| Multi-timezone | MVP |
| i18n UI | P2 |
| Feature flags | MVP |
| Rate limiting | MVP |
| CAPTCHA on public forms | MVP |
| File virus scanning | MVP |
| GDPR export/delete | MVP |
| Cookie consent | MVP |
| Accessibility WCAG 2.2 AA | MVP target |
| Soft delete + restore | MVP |
| CSRF/XSS protections | MVP |

---

## 12. Ranking Model (Explainable) — MVP

**CompanyScore** (0–100) approximate weights:

| Signal | Weight | Notes |
|--------|--------|-------|
| Profile completeness | 20 | |
| Verification status | 15 | |
| Review score × volume confidence | 25 | Bayesian average |
| Response SLA | 10 | Median first response |
| Portfolio/case freshness | 10 | |
| Engagement quality | 10 | Hire rate, spam rejects |
| Penalty flags | − | Spam, fake review, policy |

Featured listings may boost **position in designated slots**, not raw CompanyScore. UI must label “Featured”.

---

## 13. Analytics Events (Minimum)

`search_performed`, `ai_search_performed`, `profile_viewed`, `compare_added`, `lead_submitted`, `project_created`, `proposal_submitted`, `proposal_hired`, `message_sent`, `review_submitted`, `plan_upgraded`, `ai_generation_used`, `verification_submitted`, `filter_applied`, `saved_search_created`

---

## 14. Feature Acceptance Checklist (MVP Gate)

- [ ] Auth: email, Google, LinkedIn, OTP, 2FA, reset
- [ ] Company profile complete field set + media
- [ ] Search + filters + autocomplete + saved searches
- [ ] AI smart search + description generator + matching
- [ ] Projects + proposals + hire + messaging
- [ ] Reviews + moderation + AI summary
- [ ] Subscriptions + Stripe/Razorpay webhooks + invoices
- [ ] Admin queues + CMS + SEO basics
- [ ] Programmatic SEO routes + schema + sitemaps
- [ ] GDPR export/delete + audit logs + RBAC

---

*Next: [05 — Page Specifications](./05-page-specifications.md)*
