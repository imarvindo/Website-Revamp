# API Documentation — REST Contracts

**Product:** ForgeLink  
**Document:** 07 — API Documentation  
**Version:** 1.0.0  
**Base URL:** `https://api.forgelink.com/api/v1`  
**Style:** JSON:API-ish pragmatic REST (JSON envelopes)  

---

## 1. Conventions

### 1.1 Request / Response Envelope

**Success**
```json
{
  "data": {},
  "meta": { "request_id": "uuid" }
}
```

**Collection**
```json
{
  "data": [],
  "meta": {
    "request_id": "uuid",
    "page": 1,
    "per_page": 20,
    "total": 100,
    "total_pages": 5
  }
}
```

**Error**
```json
{
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Human readable message",
    "details": { "email": ["Email is required"] },
    "request_id": "uuid"
  }
}
```

### 1.2 Standard Error Codes

| HTTP | Code | Meaning |
|------|------|---------|
| 400 | `BAD_REQUEST` | Malformed |
| 401 | `UNAUTHENTICATED` | Missing/invalid token |
| 403 | `FORBIDDEN` | Authenticated but not allowed |
| 404 | `NOT_FOUND` | Resource missing |
| 409 | `CONFLICT` | Unique/state conflict |
| 422 | `VALIDATION_ERROR` | Field validation |
| 429 | `RATE_LIMITED` | Too many requests |
| 402 | `PAYMENT_REQUIRED` | Plan/limit exceeded |
| 500 | `INTERNAL_ERROR` | Unexpected |
| 503 | `SERVICE_UNAVAILABLE` | Dependency down |

### 1.3 Authentication

| Mode | Usage |
|------|-------|
| Bearer JWT access token | Most endpoints |
| Refresh token | `POST /auth/refresh` |
| OAuth code exchange | Social login |
| Webhook signatures | Stripe/Razorpay |
| Admin | Same JWT + platform roles |

### 1.4 Common Headers

- `Authorization: Bearer <token>`
- `X-Request-Id` (optional client; server always returns)
- `Accept-Language`
- `Idempotency-Key` on payments & project publish

### 1.5 Pagination & Sorting

`?page=1&per_page=20&sort=-created_at`  
Max `per_page` = 100 unless admin export.

---

## 2. Auth APIs

### POST `/auth/register`
**Auth:** None  
**Body:**
```json
{
  "name": "Priya Shah",
  "email": "priya@example.com",
  "password": "Str0ng!Pass",
  "account_type": "client",
  "company_name": null,
  "consent_tos": true,
  "consent_privacy": true
}
```
**Validation:** email unique; password policy; consent true; if `account_type=company` then `company_name` required  
**Response 201:** `{ user, organization?, tokens? }` or verification-required flag  
**Errors:** 422, 409 email taken  

### POST `/auth/login`
**Body:** `{ "email", "password", "otp_code?", "totp_code?" }`  
**Response 200:** tokens OR `{ "mfa_required": true, "mfa_token": "..." }`  
**Errors:** 401, 429 lockout  

### POST `/auth/refresh`
**Body:** `{ "refresh_token" }`  
**Response:** new access + rotated refresh  

### POST `/auth/logout`
**Auth:** Required  
**Effect:** revoke refresh/session  

### POST `/auth/forgot-password`
**Body:** `{ "email" }`  
**Response 202:** always generic success  

### POST `/auth/reset-password`
**Body:** `{ "token", "password", "password_confirmation" }`  

### POST `/auth/verify-email`
**Body:** `{ "token" }`  

### POST `/auth/otp/send` & `/auth/otp/verify`
**Validation:** purpose enum; rate limit per email/IP  

### GET `/auth/oauth/{provider}/redirect`
**Providers:** `google`, `linkedin`  

### POST `/auth/oauth/{provider}/callback`
**Body:** `{ "code", "state" }`  

### POST `/auth/2fa/setup` → `{ otpauth_url, secret }`  
### POST `/auth/2fa/confirm` `{ "code" }`  
### POST `/auth/2fa/disable` `{ "password", "code" }`  
### POST `/auth/2fa/verify` `{ "mfa_token", "code" }`  

---

## 3. Users & Notifications

### GET `/users/me`
### PATCH `/users/me`
**Body:** name, avatar_url, timezone, locale, phone  
### POST `/users/me/password`
**Body:** current_password, password, password_confirmation  
### GET `/users/me/sessions`  
### DELETE `/users/me/sessions/{id}`  
### GET `/users/me/export` → 202 job  
### DELETE `/users/me` → GDPR delete request  

### GET `/notifications`
### POST `/notifications/read-all`
### PATCH `/notifications/{id}/read`
### GET/PATCH `/users/me/notification-preferences`

---

## 4. Taxonomies & Geo

### GET `/services` | `/technologies` | `/industries` | `/languages`
Query: `q`, `parent_id`, `published=1`  

### GET `/geo/countries`
### GET `/geo/countries/{iso2}/cities?q=`

---

## 5. Companies (Public)

### GET `/companies`
Query filters: `q`, `country`, `city`, `service`, `technology`, `industry`, `size`, `rate_min`, `rate_max`, `budget_min`, `rating_min`, `verified`, `awards`, `featured`, `languages`, `sort`, `page`  
**Auth:** Optional  
**Response:** company cards + meta facets optional  

### GET `/companies/{slug}`
**Response:** full public profile aggregate  

### GET `/companies/{slug}/portfolio`
### GET `/companies/{slug}/portfolio/{itemSlug}`
### GET `/companies/{slug}/case-studies`
### GET `/companies/{slug}/case-studies/{caseSlug}`
### GET `/companies/{slug}/reviews`
### GET `/companies/{slug}/faqs`
### GET `/companies/{slug}/employees`
### GET `/companies/{slug}/locations`

---

## 6. Search & AI Search

### GET `/search/companies`
Same filters as companies list; optimized for search UI; includes `highlights`  

### GET `/search/autocomplete?q=`
**Response:** `{ companies[], services[], technologies[], locations[], queries[] }`  

### GET `/search/facets`
Returns countable facets for current filter context  

### POST `/ai/search`
**Auth:** Optional  
**Body:**
```json
{
  "query": "Need React and Node fintech team in CET under $80/hr",
  "limit": 20
}
```
**Response:**
```json
{
  "data": {
    "interpreted_filters": { "technologies": ["react","node"], "hourly_rate_max": 8000, "timezone": "CET" },
    "results": [
      { "company": {}, "match_score": 87.2, "reasons": ["React listed", "Fintech case study"] }
    ]
  }
}
```
**Errors:** 429 guest quota; 402 credit exceeded (if metered)  

---

## 7. Saved & Compare

### GET/POST/DELETE `/saved-companies`
### GET/POST/PATCH/DELETE `/saved-searches`
### GET/PUT `/comparisons/current`  
**Body:** `{ "company_ids": ["..."] }` max 4  

---

## 8. Studio — Company Management

**Auth:** Company member with suitable org_role  

### GET `/studio/dashboard`
### GET `/studio/company`
### PATCH `/studio/company`
### POST `/studio/company/publish`
### POST `/studio/media` (multipart or presign)
### PATCH `/studio/media/reorder`
### DELETE `/studio/media/{id}`

### CRUD `/studio/portfolio`
### CRUD `/studio/case-studies`
### PUT `/studio/taxonomies` `{ services:[], technologies:[], industries:[] }`
### CRUD `/studio/employees`
### CRUD `/studio/locations`
### CRUD `/studio/faqs`
### CRUD `/studio/awards`
### CRUD `/studio/certifications`
### CRUD `/studio/downloads`

### GET `/studio/leads`
### GET `/studio/leads/{id}`
### PATCH `/studio/leads/{id}` `{ status, assigned_to }`
### POST `/studio/leads/{id}/accept` → creates thread

### GET `/studio/proposals`
### POST `/studio/proposals/{id}/withdraw`

### GET `/studio/reviews`
### POST `/studio/reviews/{id}/reply` `{ body }`
### POST `/studio/reviews/invites` `{ emails[], message? }`

### GET `/studio/analytics?range=30d`
### GET `/studio/activity`
### GET/POST `/studio/verification`
### GET/POST/PATCH `/studio/members` & invites
### GET `/studio/usage`

---

## 9. Leads (Public Create)

### POST `/leads`
**Auth:** Optional  
**Body:**
```json
{
  "company_slug": "acme-labs",
  "name": "Priya Shah",
  "email": "priya@example.com",
  "client_company": "Northwind",
  "budget_min": 1000000,
  "budget_max": 2500000,
  "currency": "USD",
  "message": "We need a mobile MVP in 12 weeks...",
  "captcha_token": "..."
}
```
**Validation:** message 20–5000; CAPTCHA; rate limit per IP/company  
**Response 201:** `{ id, status: "new" }`  

---

## 10. Projects & Proposals

### POST `/projects`
**Auth:** Client  
**Body:** wizard payload (title, description, budget_*, timeline, visibility, nda_required, preferred_countries, remote_ok, service_ids, technology_ids, file_ids)  
**Response 201:** project (`draft` or `pending_moderation`)  

### GET `/projects` (marketplace browse)
**Auth:** Provider  
**Query:** skills, budget, country, q, sort, page  

### GET `/projects/{id}`
### PATCH `/projects/{id}`
### POST `/projects/{id}/publish`
### POST `/projects/{id}/close`
### POST `/projects/{id}/cancel`

### POST `/projects/{id}/invitations` `{ company_ids: [] }`
### POST `/projects/{id}/invitations/{id}/respond` `{ accept: true }`

### POST `/projects/{id}/nda/accept`

### POST `/projects/{id}/proposals`
**Auth:** Provider org  
**Body:** cover_letter, approach, bid_amount, bid_type, currency, timeline_text, milestones, attachment_ids  
**Errors:** 402 proposal limit; 409 already proposed; 403 unverified restrictions  

### GET `/projects/{id}/proposals` (owner)
### GET `/proposals/{id}`
### POST `/projects/{id}/proposals/{id}/shortlist`
### POST `/projects/{id}/hire`
**Body:** `{ "proposal_id", "message?" }`  
**Effect:** accept winner, decline others, project=`hired`, open/ensure thread  

---

## 11. Messaging

### GET `/messages/threads`
### POST `/messages/threads`
**Body:** `{ type, participant_user_ids, company_id?, project_id?, lead_id?, subject? }`  

### GET `/messages/threads/{id}`
### GET `/messages/threads/{id}/messages?before=&limit=`
### POST `/messages/threads/{id}/messages`
**Body:** `{ body, attachment_ids? }`  
### POST `/messages/threads/{id}/read`
### POST `/messages/threads/{id}/report`

**Realtime:** WebSocket auth via JWT; events `message.created`, `typing.started`, `typing.stopped`, `message.read`

---

## 12. Reviews

### POST `/reviews`
**Auth:** Client  
**Body:** company_id/slug, project_id?, rating*, title?, body, invite_token?  
### PATCH `/reviews/{id}` (edit window)
### POST `/reviews/{id}/vote` `{ helpful: true }`
### POST `/reviews/{id}/report`
### GET `/companies/{slug}/reviews/summary` AI summary

---

## 13. AI APIs

All AI endpoints: Auth required (except limited smart search), credit-metered, return `generation_id`.

| Method | Endpoint | Body (key fields) |
|--------|----------|-------------------|
| POST | `/ai/search` | query |
| POST | `/ai/match-companies` | brief / project_id |
| POST | `/ai/recommend-projects` | company_id |
| POST | `/ai/proposal-writer` | project_id, tone? |
| POST | `/ai/company-description` | company_id, variants? |
| POST | `/ai/seo-meta` | entity_type, entity_id |
| POST | `/ai/faq-generator` | company_id |
| POST | `/ai/blog-writer` | outline (P2) |
| POST | `/ai/review-analysis` | company_id |
| POST | `/ai/lead-score` | lead_id |

**Response pattern:**
```json
{
  "data": {
    "generation_id": "uuid",
    "output": {},
    "credits_used": 2,
    "credits_remaining": 98
  }
}
```
**Errors:** 402 insufficient credits; 422 unsafe/blocked content  

### POST `/ai/generations/{id}/publish`
Applies output to entity after human approval (description/faqs/meta).

---

## 14. Billing

### GET `/billing/plans`
### POST `/billing/checkout`
**Body:** `{ plan_code, interval, coupon_code?, success_url, cancel_url, provider? }`  
**Response:** `{ checkout_url }`  

### POST `/billing/portal` → customer portal URL  
### GET `/billing/subscription`  
### GET `/billing/invoices`  
### GET `/billing/invoices/{id}`  
### POST `/billing/coupons/validate` `{ code, plan_code }`  
### POST `/billing/featured/checkout` `{ placement_key, target }`  

### POST `/webhooks/stripe`
### POST `/webhooks/razorpay`
**Auth:** Signature  
**Effect:** sync subscription/invoice entitlements idempotently  

---

## 15. Uploads

### POST `/uploads/presign`
**Body:** `{ filename, mime, size, purpose }`  
**Response:** `{ upload_url, file_id, headers }`  
### POST `/uploads/{id}/complete`
Virus scan queued; status `quarantined|clean|infected`

---

## 16. SEO / Public Content

### GET `/home/bootstrap`
### GET `/cms/pages/{slug}`
### GET `/blog/posts`
### GET `/blog/posts/{slug}`
### GET `/faqs?topic=`
### GET `/seo/pages/{path}`
### GET `/sitemaps/{name}.xml` (or static via CDN)

---

## 17. Admin APIs

Prefix `/admin`. Auth: platform roles.

| Area | Endpoints |
|------|-----------|
| Dashboard | `GET /admin/dashboard` |
| Users | `GET/PATCH /admin/users`, suspend, roles |
| Companies | `GET/PATCH /admin/companies` |
| Verification | `GET /admin/verifications`, `POST .../approve|reject` |
| Projects | `GET/PATCH /admin/projects` |
| Reviews | `GET/PATCH /admin/reviews` |
| Reports | `GET/PATCH /admin/reports` |
| CMS/Blog | full CRUD |
| SEO pages | CRUD + publish |
| Redirects | CRUD |
| Taxonomy | CRUD |
| Plans/Coupons | CRUD |
| Featured inventory | CRUD |
| Email templates | CRUD |
| Feature flags | CRUD |
| Settings | GET/PATCH |
| Audit logs | GET |
| AI prompts | CRUD |
| Revenue | `GET /admin/revenue` |

**Admin mutation body** often requires `{ reason }` for trust actions.

---

## 18. Support

### POST `/support/contact`
**Body:** name, email, topic, message, captcha_token  

---

## 19. Rate Limits (Default)

| Surface | Limit |
|---------|-------|
| Auth login | 10 / 15min / IP+email |
| Public lead form | 5 / hour / IP / company |
| Autocomplete | 60 / min / IP |
| AI guest search | 10 / day / IP |
| AI auth | per plan credits + 30 / min |
| Messaging send | 60 / min / user |
| Admin | 120 / min |

Return `Retry-After` on 429.

---

## 20. Idempotency & Webhooks

- Checkout, hire, publish project: require `Idempotency-Key` uniqueness for 24h
- Webhooks: store `provider_event_id` UNIQUE; process exactly-once

---

## 21. OpenAPI Delivery Note for Engineering

Implement OpenAPI 3.1 at `/openapi.json` generated from Laravel API definitions (Scramble/Scribe) and consume from Next.js typed client. This PRD is the normative contract until OpenAPI is published in-repo.

---

*Next: [08 — Architecture, Security & Performance](./08-architecture-security-performance.md)*
