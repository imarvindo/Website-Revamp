# SEO Agency Website (SearchEngineOptimization.ae)

Premium enterprise digital marketing agency website for SEO.ae — Dubai's #1 SEO & digital growth partner. A full-stack React + Vite site with a complete backend API, database, and all key pages.

## Run & Operate

- `pnpm --filter @workspace/seo-agency run dev` — run the frontend (uses PORT from artifact config)
- `pnpm --filter @workspace/api-server run dev` — run the API server (port 8080, proxied at `/api`)
- `pnpm run typecheck` — full typecheck across all packages
- `pnpm --filter @workspace/api-spec run codegen` — regenerate API hooks and Zod schemas from the OpenAPI spec
- `pnpm --filter @workspace/db run push` — push DB schema changes (dev only)
- Required env: `DATABASE_URL` — Postgres connection string (auto-provisioned)

## Stack

- pnpm workspaces, Node.js 24, TypeScript 5.9
- Frontend: React + Vite, Framer Motion, Tailwind CSS v4, wouter, TanStack Query
- API: Express 5
- DB: PostgreSQL + Drizzle ORM
- Validation: Zod (v3), `drizzle-zod`
- API codegen: Orval (from OpenAPI spec at `lib/api-spec/openapi.yaml`)
- UI: shadcn/ui components + lucide-react + react-icons

## Where things live

- Frontend pages: `artifacts/seo-agency/src/pages/`
- Layout components: `artifacts/seo-agency/src/components/layout/`
- API routes: `artifacts/api-server/src/routes/`
- DB schema: `lib/db/src/schema/`
- OpenAPI spec: `lib/api-spec/openapi.yaml`
- Generated hooks: `lib/api-client-react/src/generated/`
- Generated Zod schemas: `lib/api-zod/src/generated/`

## Pages

- `/` — Homepage (hero, stats, services, case studies, testimonials, blog)
- `/about` — About Us
- `/services` — Services overview
- `/seo`, `/ai-search-optimization`, `/ppc`, `/social-media-marketing`, `/web-design`, `/web-development` — Individual service pages
- `/blog`, `/blog/:slug` — Blog listing + single post
- `/case-studies` — Case studies with filter
- `/portfolio` — Portfolio grid
- `/contact` — Contact form
- `/careers` — Careers page
- `/locations/dubai` — Dubai location page

## Architecture decisions

- Date fields: Drizzle returns `Date` objects; all routes call `serializeDates()` before Zod `.parse()` to convert to ISO strings (OpenAPI spec declares timestamps as `string`)
- No `integer` or `email` format in OpenAPI spec — Zod v3 doesn't support `zod.int()` / `zod.email()` (Orval-generated). Use `number` and plain `string` instead.
- Color system: deep navy background (`hsl(221 48% 6%)`), electric blue primary (`hsl(221 83% 53%)`), gold accent (`hsl(44 57% 42%)`)
- Font: Plus Jakarta Sans (Google Fonts, loaded in index.css)

## Product

Full-stack digital marketing agency website with:
- Rich homepage with animated stats counters, services grid, testimonials
- All key service pages (SEO, AI Search, PPC, Social Media, Web Design, Web Dev)
- Blog with categories and reading time
- Case studies with real metrics
- Portfolio grid
- Contact form that saves to DB
- Newsletter subscription
- Sticky mega-menu navigation
- Premium dark design with framer-motion animations

## User preferences

_Populate as you build — explicit user instructions worth remembering across sessions._

## Gotchas

- After any OpenAPI spec change, must run codegen then `pnpm run typecheck:libs` before API server typecheck sees new exports
- `react-icons/si` does not export `SiLinkedin` — use `Linkedin` from `lucide-react` instead
- `pnpm --filter @workspace/seo-agency run typecheck` not `build` (build requires PORT/BASE_PATH env vars from workflow)

## Pointers

- See the `pnpm-workspace` skill for workspace structure, TypeScript setup, and package details
