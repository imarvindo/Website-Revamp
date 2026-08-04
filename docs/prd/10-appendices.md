# Appendices — Implementation Details

**Product:** ForgeLink  
**Document:** 10 — Appendices  
**Version:** 1.0.0  

---

## Appendix A — Glossary

| Term | Definition |
|------|------------|
| Buyer / Client | User seeking to discover or hire IT providers |
| Company / Agency | Supplier organization with a public profile |
| Completeness Score | 0–100 profile fill metric |
| Company Score | Explainable ranking score 0–100 |
| Featured Listing | Paid placement slot (labeled, not score rewrite) |
| Lead | Inbound inquiry to a company |
| Project | Structured brief requesting proposals |
| Proposal | Supplier bid on a project |
| Verification | Trust process confirming company legitimacy |
| AI Credit | Metered unit for AI feature usage |
| Programmatic SEO Page | Auto/taxonomy-generated indexable directory page |
| Studio | Company workspace (`/studio`) |
| Outbox | Reliable async event table for projections |

---

## Appendix B — Notification Matrix

| Event | In-App | Email | Default |
|-------|--------|-------|---------|
| Email verification | — | ✓ | On |
| Password reset | — | ✓ | On |
| New lead received | ✓ | ✓ | On |
| Lead assigned | ✓ | ✓ | On |
| Project invite | ✓ | ✓ | On |
| New proposal received | ✓ | ✓ | On |
| Proposal accepted/declined | ✓ | ✓ | On |
| New message | ✓ | Digest optional | In-app on; email digest daily default |
| Review received | ✓ | ✓ | On |
| Review reply | ✓ | ✓ | On |
| Verification status change | ✓ | ✓ | On |
| Saved search match | ✓ | Digest | Weekly default |
| Subscription renewing | ✓ | ✓ | On |
| Payment failed | ✓ | ✓ | On |
| Proposal limit near | ✓ | ✓ | On |
| AI credits low | ✓ | ✓ | On |
| Abuse report update | ✓ | ✓ | On (staff) |
| Moderation queue SLA breach | ✓ | ✓ | On (staff) |

---

## Appendix C — Email Templates Catalog

| Template Key | Variables |
|--------------|-----------|
| `auth.verify_email` | user_name, verify_url |
| `auth.reset_password` | user_name, reset_url |
| `auth.otp` | otp_code, expires_minutes |
| `org.invite` | inviter_name, org_name, role, accept_url |
| `lead.new` | company_name, lead_name, budget, message_excerpt, inbox_url |
| `project.invited` | project_title, client_name, project_url |
| `proposal.new` | project_title, company_name, bid, proposals_url |
| `proposal.status` | project_title, status, url |
| `message.new_digest` | threads[], messages_url |
| `review.new` | company_name, rating, review_url |
| `verification.status` | status, notes, studio_url |
| `billing.invoice` | invoice_number, amount, pdf_url |
| `billing.payment_failed` | amount, update_url |
| `search.alert` | search_name, companies[] |
| `review.request` | client_name, company_name, review_url |

All templates support locale key suffix in Phase 2 (`auth.verify_email.en`).

---

## Appendix D — Analytics Event Dictionary

| Event | Properties (minimum) |
|-------|----------------------|
| `search_performed` | q, filters_hash, result_count, sort |
| `ai_search_performed` | query_len, interpreted_filters, result_count, latency_ms |
| `autocomplete_selected` | type, id |
| `profile_viewed` | company_id, source, is_featured_slot |
| `compare_added` | company_id, count |
| `lead_submitted` | company_id, has_budget |
| `project_created` | visibility, budget_type |
| `project_published` | project_id |
| `proposal_submitted` | project_id, company_id, bid_amount |
| `proposal_hired` | project_id, proposal_id |
| `message_sent` | thread_id, has_attachment |
| `review_submitted` | company_id, rating, verified |
| `plan_checkout_started` | plan_code, provider |
| `plan_upgraded` | from_plan, to_plan |
| `featured_purchased` | placement_key |
| `ai_generation_used` | feature_key, credits |
| `ai_generation_published` | feature_key, entity_type |
| `verification_submitted` | company_id |
| `verification_resolved` | status |
| `saved_search_created` | alert_enabled |
| `filter_applied` | filter_key, value_count |
| `cta_clicked` | cta_id, page |

Privacy: no message bodies; no raw PII in analytics payloads.

---

## Appendix E — Seed Taxonomy (MVP Starter Set)

### Services (sample; expand via Admin)
Web Development, Mobile App Development, UI/UX Design, Product Design, SaaS Development, Custom Software, DevOps, Cloud Consulting, Data Engineering, AI/ML Development, Cybersecurity, QA & Testing, Shopify Development, WordPress Development, SEO Services, Performance Marketing, Branding, CRM Implementation, ERP Consulting, Blockchain Development, Staff Augmentation, CTO as a Service

### Technologies (sample)
React, Next.js, Vue, Angular, Node.js, Laravel, PHP, Python, Django, FastAPI, Java, Spring, .NET, Go, Ruby on Rails, Swift, Kotlin, Flutter, React Native, PostgreSQL, MySQL, MongoDB, Redis, Kubernetes, AWS, Azure, GCP, Terraform, GraphQL, TypeScript, TailwindCSS

### Industries (sample)
Fintech, Healthcare, Ecommerce, Education, Real Estate, Travel, Logistics, Media, Gaming, Government, Energy, Manufacturing, LegalTech, MarTech, HRTech, ClimateTech

### Size Bands
`1-10`, `11-50`, `51-200`, `201-500`, `501+`

---

## Appendix F — Company Completeness Scoring Rubric

| Item | Points |
|------|--------|
| Logo | 5 |
| Cover | 3 |
| Tagline | 3 |
| Description ≥ 400 chars | 10 |
| Website | 4 |
| ≥3 services | 8 |
| ≥5 technologies | 8 |
| ≥1 industry | 4 |
| Hourly rate range | 6 |
| Min budget | 3 |
| ≥1 location | 6 |
| ≥2 portfolio items | 10 |
| ≥1 case study | 8 |
| ≥1 team member public | 5 |
| ≥3 FAQs | 5 |
| Social links ≥1 | 3 |
| Languages set | 3 |
| Verification submitted/approved | 6 |
| **Total** | **100** |

---

## Appendix G — Verification Checklist (Ops)

1. Legal/trading name consistency
2. Website domain resolves; matches claim
3. Corporate registry document (region-specific)
4. Work email on same domain (preferred)
5. Duplicate/impersonation search
6. Office address plausibility
7. Portfolio originality spot-check
8. Sanctions/OSINT light screen (policy-defined)
9. Approve / needs_info / reject with reason codes

**Reason codes:** `docs_insufficient`, `domain_mismatch`, `duplicate_entity`, `impersonation`, `policy_violation`, `unable_to_verify`

---

## Appendix H — Moderation Severity

| Severity | Examples | SLA |
|----------|----------|-----|
| S0 | Illegal content, threats | 1h |
| S1 | Fraudulent company, doxxing | 4h |
| S2 | Fake reviews, spam projects | 24h |
| S3 | Minor policy / quality | 72h |

---

## Appendix I — Rate Card Notes (Indicative, Configurable)

Final commercial numbers are config, not code:

| Plan | Monthly | Annual (≈2 months free) |
|------|---------|-------------------------|
| Free | $0 | $0 |
| Starter | $49 | $490 |
| Professional | $149 | $1490 |
| Enterprise | Custom | Custom |

Featured slot day-rates vary by page competitiveness (category auction later).

---

## Appendix J — Non-Functional Requirements (NFR)

### Reliability
- RPO ≤ 5 minutes (PITR)
- RTO ≤ 1 hour for primary region failure (MVP target)
- Graceful degradation matrix per Doc 08

### Scalability
- Horizontal API/workers
- Search cluster separable
- Object storage virtually unlimited

### Accessibility
- WCAG 2.2 AA target on public + app shells
- Keyboard navigable compare tray, filters, messaging
- Alt text required for company media

### Internationalization Ready
- Externalize strings from day one
- ICU message format
- RTL-ready layout primitives even if EN-only MVP

### Compliance
- GDPR DSR workflows
- Cookie consent categories: necessary / analytics / marketing
- Review authenticity policy published

---

## Appendix K — Environment Variables (Catalog)

| Variable | Purpose |
|----------|---------|
| `APP_KEY` | Laravel encryption |
| `APP_URL` / `NEXT_PUBLIC_APP_URL` | Public URLs |
| `DATABASE_URL` | Postgres |
| `REDIS_URL` | Cache/queues auxiliary |
| `RABBITMQ_URL` | Brokers |
| `MEILISEARCH_HOST` / `KEY` | Search |
| `AWS_ACCESS_KEY_ID` / `SECRET` / `BUCKET` / `REGION` | S3 |
| `SES_REGION` / identities | Email |
| `JWT_PRIVATE_KEY` / `PUBLIC_KEY` | Auth |
| `GOOGLE_CLIENT_ID/SECRET` | OAuth |
| `LINKEDIN_CLIENT_ID/SECRET` | OAuth |
| `STRIPE_SECRET` / `WEBHOOK_SECRET` | Payments |
| `RAZORPAY_KEY` / `SECRET` / `WEBHOOK_SECRET` | Payments |
| `AI_API_KEY` / `AI_BASE_URL` | AI provider |
| `GOOGLE_MAPS_API_KEY` | Maps |
| `CAPTCHA_SECRET` | Bot protection |
| `SENTRY_DSN` | Errors |
| `FEATURE_FLAG_DEFAULTS` | JSON |

---

## Appendix L — Test Strategy

| Layer | Scope |
|-------|-------|
| Unit | Domain services, scorers, entitlement math |
| Integration | API + DB + queue fakes |
| Contract | OpenAPI validation |
| E2E | Auth, publish profile, search, lead, project hire, checkout |
| Load | Search, profile ISR, proposal storms |
| Security | OWASP ASVS-inspired checklist; dependency scans |
| SEO | Schema validators; crawl staging; CWV lab+field |

---

## Appendix M — Content Moderation AI Policy

- AI may **pre-score** reviews/projects for spam; humans decide removals for edge cases
- AI must not invent client names, revenue figures, or awards in generations
- All public AI text shows disclosure where legally required
- Prompt injection defenses: separate system instructions; strip tool calls from user HTML

---

## Appendix N — Programmatic SEO Quality Gates

Publish a combo page only if ALL true:
1. `company_count >= SEO_MIN_COMPANIES` (default 5)
2. Unique intro ≥ 120 words (template + entities filled)
3. Not cannibalizing higher-priority canonical
4. Taxonomy nodes published
5. Noindex flag false

Unpublish automatically if count falls below threshold for 14 days.

---

## Appendix O — Sample Sequence: Hire Happy Path

```mermaid
sequenceDiagram
  participant B as Buyer
  participant API as API
  participant Q as Queue
  participant C as Company User
  participant WS as WebSocket
  B->>API: POST /projects (publish)
  API->>Q: index project + notify matches
  Q->>C: email+in-app invite/match
  C->>API: POST /projects/{id}/proposals
  API->>B: notification new proposal
  B->>API: POST /projects/{id}/hire
  API->>API: accept/decline proposals; status=hired
  API->>WS: thread updated
  B->>WS: kickoff message
  C->>WS: reply
  API->>Q: schedule review request +T
```

---

## Appendix P — Admin Report Types

| Report | Columns (sample) | Format |
|--------|------------------|--------|
| Users growth | date, signups, activations | CSV |
| Companies | date, published, verified | CSV |
| Marketplace | projects, proposals, hires | CSV |
| Revenue | MRR, new, churn, expansion | CSV |
| Trust | reports, median resolve hours | CSV |
| AI usage | feature_key, tokens, cost | CSV |
| SEO | indexed pages, clicks (if connected) | CSV |

---

## Appendix Q — Acceptance Test Scripts (Smoke)

1. Register client → verify email → login  
2. Register company → complete profile → publish → appears in search within 60s  
3. Guest search → open profile → submit lead (CAPTCHA) → company sees lead  
4. Client posts project → company proposes → client hires → both see thread  
5. Client submits review → appears after moderation/auto-approve rules  
6. Company upgrades via Stripe test card → proposal limit increases  
7. Admin verifies company → badge visible  
8. AI description generated → approve → public profile updates  
9. SEO service page returns 200 + FAQ schema  
10. GDPR export request completes  

---

## Appendix R — Open Product Configuration Decisions

These do **not** block engineering scaffolds; set before GA marketing:

1. Exact list prices & annual discount  
2. SEO_MIN_COMPANIES threshold per market  
3. AI vendor primary/fallback  
4. Primary AWS region  
5. Brand visual identity (logo, illustration system)  
6. Initial seed acquisition strategy for companies  
7. Support email/SLA public copy  

---

*Return to [README / Index](./README.md)*
