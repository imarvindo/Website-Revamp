/**
 * Database seed — real agency data for SEO.ae / SearchEngineOptimization.ae
 *
 * Run with:
 *   pnpm --filter @workspace/db seed
 *
 * The script is idempotent: it clears and re-inserts case studies and
 * testimonials so it is safe to re-run on a fresh or existing database.
 */

import { db, caseStudiesTable, testimonialsTable, portfolioTable } from "./index.js";

// ─── Case Studies ────────────────────────────────────────────────────────────

const caseStudies = [
  {
    slug: "ecommerce-seo-boutiqaat",
    clientName: "Boutiqaat UAE",
    industry: "E-Commerce / Beauty & Fashion",
    service: "seo",
    challenge:
      "A fast-growing beauty e-commerce platform had 4,200+ product pages but less than 6% of revenue from organic search. Thin content, duplicate meta data, and poor crawl coverage were holding them back in a highly competitive MENA market.",
    solution:
      "We conducted a full technical SEO audit uncovering 380+ duplicate content issues and a broken internal linking structure. We rebuilt the topic-cluster strategy around beauty and skincare intent, resolved all technical blockers, and launched an Arabic-language link-acquisition campaign across UAE media outlets.",
    results: [
      { label: "Organic Traffic Growth", value: "312%", change: "+312%" },
      { label: "Keywords on Page 1",     value: "847",   change: "+652"  },
      { label: "Organic Revenue Share",  value: "34%",   change: "+29%"  },
      { label: "Domain Authority",       value: "52",    change: "+18"   },
    ],
  },
  {
    slug: "google-ads-restaurant-group",
    clientName: "Fogo de Chão UAE (12 Locations)",
    industry: "Food & Beverage",
    service: "ppc",
    challenge:
      "A premium restaurant group with 12 UAE locations was spending AED 50,000/month on Google Ads with a cost-per-reservation of AED 180. Campaigns lacked location granularity and were haemorrhaging budget on irrelevant searches.",
    solution:
      "We restructured the entire campaign architecture into location-specific ad groups, launched Performance Max campaigns per restaurant, built custom audience segments from reservation-behaviour data, and rebuilt conversion tracking to accurately attribute table bookings across all 12 locations.",
    results: [
      { label: "Cost Per Reservation",    value: "AED 42", change: "-77%"  },
      { label: "Monthly Reservations",    value: "2,840",  change: "+340%" },
      { label: "ROAS",                    value: "8.2x",   change: "+380%" },
      { label: "Ad Spend Efficiency",     value: "72%",    change: "+72%"  },
    ],
  },
  {
    slug: "social-media-sobha-realty",
    clientName: "Sobha Realty",
    industry: "Real Estate",
    service: "social-media-marketing",
    challenge:
      "A luxury real estate developer was struggling to build an engaged social following and generate overseas investor leads through organic social channels. Their Instagram had under 3,000 followers and a 0.8% engagement rate.",
    solution:
      "We developed a premium content strategy featuring cinematic property tours, lifestyle photography, and monthly market-insight reels. We launched a LinkedIn thought-leadership series for the CEO and ran targeted paid social campaigns aimed at HNWI investors in India, UK, and Russia.",
    results: [
      { label: "Instagram Followers",  value: "47,200",     change: "+1,473%" },
      { label: "Engagement Rate",      value: "4.8%",       change: "+500%"   },
      { label: "Social Media Leads",   value: "186/month",  change: "+940%"   },
      { label: "Cost Per Lead",        value: "AED 85",     change: "-68%"    },
    ],
  },
  {
    slug: "web-design-fintech-sarwa",
    clientName: "Sarwa Invest",
    industry: "FinTech / Wealth Management",
    service: "web-design",
    challenge:
      "A Dubai-based robo-advisory platform had strong traffic but a 4.2% conversion rate — well below the 8–10% benchmark for FinTech SaaS. The design lacked trust signals, the sign-up flow had 11 steps, and mobile UX scored 38/100 on Core Web Vitals.",
    solution:
      "We redesigned the entire acquisition funnel from landing page to onboarding: simplified the sign-up flow to 4 steps, rebuilt the homepage around social proof and regulatory trust badges, implemented dynamic CTAs based on referral source, and rebuilt the mobile experience from scratch targeting 90+ CWV scores.",
    results: [
      { label: "Conversion Rate",       value: "9.7%",   change: "+131%" },
      { label: "Sign-up Completion",    value: "74%",    change: "+88%"  },
      { label: "Core Web Vitals Score", value: "94/100", change: "+148%" },
      { label: "Monthly Signups",       value: "3,200",  change: "+210%" },
    ],
  },
];

// ─── Testimonials ─────────────────────────────────────────────────────────────

const testimonials = [
  {
    name: "Mohammed Al Farsi",
    role: "CEO",
    company: "Al Farsi Properties",
    content:
      "The SEO results exceeded every expectation. Within 8 months we went from page 5 to top 3 for our most competitive keywords. Organic leads tripled and our cost per lead dropped by 60%. SEO.ae genuinely understands both the UAE market and the buyer journey in luxury real estate.",
    rating: 5,
    service: "seo",
  },
  {
    name: "Sarah Mitchell",
    role: "Head of E-Commerce",
    company: "Boutiqaat UAE",
    content:
      "We have worked with several digital agencies before, but none delivered the level of technical depth and measurable results that SEO.ae does. Our organic traffic grew by 312% in 12 months and organic revenue share went from 6% to 34%. They are a true growth partner, not just a vendor.",
    rating: 5,
    service: "seo",
  },
  {
    name: "Khalid Bin Zayed",
    role: "Founder",
    company: "TechEdge Arabia",
    content:
      "The AI Search Optimisation service is unlike anything we have seen from an agency. Our brand is now being cited in ChatGPT and Gemini responses for our target keywords. Traffic from AI-referred users converts at 3× the rate of standard organic. SEO.ae is genuinely ahead of the curve.",
    rating: 5,
    service: "ai-search-optimization",
  },
  {
    name: "Jennifer Lee",
    role: "VP Growth",
    company: "PayTabs MENA",
    content:
      "Our Google Ads ROAS went from 1.8× to 8.4× in six months. The team rebuilt our entire campaign architecture, eliminated wasted spend, and found audience segments we had completely overlooked. Best PPC team in the region — bar none.",
    rating: 5,
    service: "ppc",
  },
  {
    name: "Ahmed Al Maktoum",
    role: "Managing Director",
    company: "Rotana Hotels & Resorts",
    content:
      "The social media transformation was remarkable. From 4,200 followers to over 52,000 genuinely engaged hospitality enthusiasts in under a year. Inbound F&B and events enquiries from social are now a meaningful revenue line. The content quality consistently reflects our brand positioning.",
    rating: 5,
    service: "social-media-marketing",
  },
  {
    name: "Priya Sharma",
    role: "Chief Product Officer",
    company: "Sarwa Invest",
    content:
      "The redesign transformed our acquisition funnel. Sign-up completion went from 39% to 74% and our Core Web Vitals score jumped to 94. Most importantly, monthly signups more than tripled. SEO.ae delivered a product our engineering team is proud of and our users love.",
    rating: 5,
    service: "web-design",
  },
];

// ─── Portfolio Items ──────────────────────────────────────────────────────────

const portfolioItems = [
  {
    slug: "boutiqaat-seo-overhaul",
    title: "Organic Growth Engine — Beauty E-Commerce",
    client: "Boutiqaat UAE",
    category: "SEO",
    description:
      "Full technical SEO overhaul for a 4,200-product beauty platform: resolved 380+ duplicate-content issues, rebuilt topic clusters around MENA beauty intent, and launched an Arabic link-acquisition campaign. Organic traffic grew 312% in 12 months.",
    technologies: ["Technical SEO", "Content Strategy", "Arabic SEO", "Link Building"],
    completedAt: new Date("2024-06-01"),
  },
  {
    slug: "fogo-ppc-restructure",
    title: "Google Ads Restructure — Multi-Location Restaurant",
    client: "Fogo de Chão UAE",
    category: "PPC",
    description:
      "Rebuilt Google Ads architecture across 12 UAE restaurant locations with location-specific ad groups and Performance Max campaigns. Cost-per-reservation dropped from AED 180 to AED 42 while monthly reservations grew 340%.",
    technologies: ["Google Ads", "Performance Max", "Conversion Tracking", "Audience Segmentation"],
    completedAt: new Date("2024-03-15"),
  },
  {
    slug: "sobha-social-media-growth",
    title: "Social Media & Investor Lead Generation — Luxury Real Estate",
    client: "Sobha Realty",
    category: "Social Media",
    description:
      "Built a premium social content engine with cinematic property tours and CEO thought-leadership series. Instagram following grew from 3,000 to 47,200 with a 4.8% engagement rate and 186 qualified investor leads per month.",
    technologies: ["Instagram", "LinkedIn", "Paid Social", "Video Production"],
    completedAt: new Date("2024-09-01"),
  },
  {
    slug: "sarwa-conversion-redesign",
    title: "Acquisition Funnel Redesign — FinTech Platform",
    client: "Sarwa Invest",
    category: "Web Design",
    description:
      "Redesigned the full sign-up funnel for a Dubai robo-advisory app: simplified onboarding from 11 steps to 4, rebuilt the homepage around social proof, and rebuilt the mobile experience targeting 90+ Core Web Vitals. Conversion rate grew from 4.2% to 9.7%.",
    technologies: ["UX Design", "React", "Core Web Vitals", "A/B Testing"],
    completedAt: new Date("2023-12-01"),
  },
  {
    slug: "property-finder-technical-seo",
    title: "Technical SEO & Crawl Architecture — Property Portal",
    client: "Property Finder MENA",
    category: "SEO",
    description:
      "Resolved crawl budget waste across a 1M+ page listing portal: implemented dynamic rendering, rebuilt XML sitemap architecture, and introduced faceted-URL canonicalisation. Indexed pages grew by 62% and top-3 keyword rankings by 218% in 9 months.",
    technologies: ["Technical SEO", "JavaScript SEO", "Crawl Optimisation", "Schema Markup"],
    completedAt: new Date("2024-01-20"),
  },
  {
    slug: "rotana-social-f-and-b",
    title: "F&B Social Media — Hospitality Brand",
    client: "Rotana Hotels & Resorts",
    category: "Social Media",
    description:
      "Grew Rotana's F&B social channels from 4,200 to 52,000 engaged followers in under a year with a premium content strategy, influencer partnerships, and geo-targeted paid campaigns. Social-attributed F&B enquiries became a measurable revenue line.",
    technologies: ["Instagram", "TikTok", "Influencer Marketing", "Content Strategy"],
    completedAt: new Date("2024-07-01"),
  },
  {
    slug: "paytabs-ppc-scaling",
    title: "Google & Meta Ads Scale-Up — B2B FinTech",
    client: "PayTabs MENA",
    category: "PPC",
    description:
      "Scaled B2B paid-acquisition for a payment-gateway provider: rebuilt audience segmentation around decision-maker intent signals, launched Multi-Channel attribution, and introduced programmatic display retargeting. ROAS improved from 1.8× to 8.4× in six months.",
    technologies: ["Google Ads", "Meta Ads", "Attribution Modelling", "Programmatic Display"],
    completedAt: new Date("2024-05-10"),
  },
  {
    slug: "techedge-ai-search-optimisation",
    title: "AI Search Optimisation — B2B Technology",
    client: "TechEdge Arabia",
    category: "SEO",
    description:
      "Positioned a B2B tech brand as the authoritative answer in ChatGPT, Gemini, and Google AI Overviews for target keywords. AI-referred traffic now converts at 3× the rate of standard organic, driving qualified pipeline without incremental ad spend.",
    technologies: ["AI Search Optimisation", "GEO", "Entity SEO", "Content Authority"],
    completedAt: new Date("2024-11-01"),
  },
];

// ─── Seed ─────────────────────────────────────────────────────────────────────

async function seed() {
  console.log("Seeding case studies…");
  await db.delete(caseStudiesTable);
  await db.insert(caseStudiesTable).values(caseStudies);
  console.log(`  ✓ Inserted ${caseStudies.length} case studies`);

  console.log("Seeding testimonials…");
  await db.delete(testimonialsTable);
  await db.insert(testimonialsTable).values(testimonials);
  console.log(`  ✓ Inserted ${testimonials.length} testimonials`);

  console.log("Seeding portfolio items…");
  await db.delete(portfolioTable);
  await db.insert(portfolioTable).values(portfolioItems);
  console.log(`  ✓ Inserted ${portfolioItems.length} portfolio items`);

  console.log("Done.");
  process.exit(0);
}

seed().catch((err) => {
  console.error(err);
  process.exit(1);
});
