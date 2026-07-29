---
name: SEO.ae Brand & Design System
description: Color tokens, design patterns, and CSS utilities for the SEO.ae website — required reading before touching any page or component.
---

## Color Tokens (HSL values in index.css)
- Primary #16B1D4 → `191 81% 46%` — cyan CTA buttons, links, highlights
- Secondary #101A6A → `233 74% 24%` — dark navy, hero backgrounds, footer, strong CTAs
- Accent #63CCE3 → `191 70% 64%` — light cyan, decorative only
- Background #FBFBFB → `0 0% 98%` — light page background
- Surface/Card #FFFFFF → `0 0% 100%`
- Foreground #1C1C1C → `0 0% 11%` — all dark body text
- Muted fg #5D5D5D → `0 0% 36%` — secondary text
- Border #E6E6E6 → `0 0% 90%`
- Warning #F8C31C → `46 94% 54%` — star ratings
- Danger #AC192C → `352 75% 39%`

## Page Layout Pattern (mandatory)
1. Hero: `hero-dark bg-grid-pattern-dark` (dark navy bg, white text)
2. Body: alternate `bg-background` and `bg-muted/30` / `bg-white`
3. Closing CTA: `hero-dark` (dark navy, white text)

## Custom CSS Utilities (index.css)
- `hero-dark` — dark navy bg with radial cyan glows
- `bg-grid-pattern-dark` / `bg-grid-pattern` / `bg-dot-pattern`
- `section-label` — cyan pill chip for section eyebrows
- `gradient-text-primary` — cyan→navy gradient text
- `glass-panel` / `glass-panel-dark`
- `card-lift` — white card with hover lift
- `animate-float` / `glow-primary` / `divider-gradient`

## Button Variants
- `default` = cyan (#16B1D4) — primary CTA on light bg
- `gold` / `secondary` = dark navy (#101A6A) — strong CTA on light bg
- `inverted` = white — CTA inside dark/navy sections
- `outline` = cyan border — secondary CTA on light bg

**Why:** Brand shifted from dark-only to light-corporate in a full theme overhaul. These patterns are the agreed standard — deviating will break visual consistency.

## Key Files
- CSS system: `artifacts/seo-agency/src/index.css`
- Buttons: `artifacts/seo-agency/src/components/ui/button.tsx`
- Navbar: `artifacts/seo-agency/src/components/layout/Navbar.tsx`
- Footer: `artifacts/seo-agency/src/components/layout/Footer.tsx`
- Shared service layout: `artifacts/seo-agency/src/components/ServiceLayout.tsx`
- Testimonial slider: `artifacts/seo-agency/src/components/TestimonialSlider.tsx`

## Date Serialization (API Server)
Drizzle returns `Date` objects; OpenAPI spec declares timestamps as `string`. All route handlers call `serializeDates()` before Zod `.parse()`.

## Font
`Outfit` (primary), `Plus Jakarta Sans` (fallback) — loaded via Google Fonts in index.css.
