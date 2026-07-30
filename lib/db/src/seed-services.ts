/**
 * Seed all service pages — existing 6 + 7 new ones.
 * Run: pnpm --filter @workspace/db seed:services
 *
 * Idempotent: upserts by slug so it is safe to re-run.
 */

import { db, servicesTable } from "./index.js";
import { sql } from "drizzle-orm";

const services = [
  // ─── Existing 6 ────────────────────────────────────────────────────────────
  {
    slug: "seo",
    title: "Search Engine Optimisation",
    shortDescription:
      "Dominate Google's first page with data-driven SEO strategies tailored for the UAE and wider MENA market.",
    fullDescription:
      "Search engine optimisation is the single highest-ROI digital marketing channel for businesses in the UAE. With 94% of online journeys starting on Google, ranking on page one is the difference between a thriving pipeline and silence. Our SEO service covers every technical, on-page, and off-page lever that influences your organic visibility — from Core Web Vitals to authoritative Arabic-English link acquisition.",
    category: "SEO",
    icon: "TrendingUp",
    benefits: [
      "Full technical SEO audit with prioritised fix list",
      "Keyword strategy mapped to buyer intent at every funnel stage",
      "On-page optimisation for every target URL",
      "High-authority backlink acquisition from UAE and regional media",
      "Monthly reporting with revenue attribution",
      "Google Search Console & Analytics 4 management",
    ],
    process: [
      { step: 1, title: "Audit & Benchmark", description: "We crawl your entire site, analyse your backlink profile, and benchmark your rankings against the top 3 UAE competitors." },
      { step: 2, title: "Strategy & Roadmap", description: "We build a 12-month roadmap prioritising the highest-impact fixes and growth opportunities for your specific market." },
      { step: 3, title: "Technical Execution", description: "Our engineers resolve every crawlability, indexability, and Core Web Vitals issue holding your rankings back." },
      { step: 4, title: "Content & Links", description: "We publish authoritative content and earn links from respected UAE publications to build sustainable ranking power." },
      { step: 5, title: "Measure & Optimise", description: "Monthly ranking reviews, traffic analysis, and strategic pivots keep your growth compounding quarter after quarter." },
    ],
    technologies: ["Google Search Console", "Ahrefs", "Screaming Frog", "Semrush", "GA4", "Looker Studio"],
    faqs: [
      { question: "How long does SEO take to show results in the UAE?", answer: "Most clients see meaningful ranking improvements within 3–4 months. Competitive sectors like real estate and finance typically take 6–9 months for page-one dominance." },
      { question: "Do you work in Arabic as well as English?", answer: "Yes — we optimise for both English and Arabic search queries, including dialect variations specific to the UAE and GCC markets." },
      { question: "What makes UAE SEO different from global SEO?", answer: "UAE searchers use a unique mix of English and Arabic keywords, the competitive landscape is dominated by regional players, and local citations on platforms like Yellow Pages UAE and Bayut carry significant weight." },
      { question: "Will my rankings drop if I stop SEO?", answer: "Rankings built on quality content and authoritative links decay slowly — but competitors who keep investing will eventually overtake you. We recommend treating SEO as an ongoing channel, not a one-off project." },
    ],
  },
  {
    slug: "ai-search-optimization",
    title: "AI Search Optimisation",
    shortDescription:
      "Future-proof your visibility across ChatGPT, Google AI Overviews, Perplexity, and every AI-driven search surface.",
    fullDescription:
      "AI-powered search is reshaping how buyers research and decide. Google's AI Overviews now appear on over 50% of commercial queries; ChatGPT and Perplexity are replacing traditional search for millions of users. Businesses that optimise for these surfaces today will own their category tomorrow. Our AI Search Optimisation service combines traditional SEO fundamentals with the emerging science of LLM-visibility — ensuring your brand is cited, quoted, and recommended by AI models.",
    category: "AI & Search",
    icon: "Cpu",
    benefits: [
      "Audit of current AI Overview and LLM citation visibility",
      "Structured data implementation for AI snippet eligibility",
      "Entity optimisation so AI models recognise your brand accurately",
      "FAQ and People Also Ask content strategy",
      "Monitoring of AI citation share versus competitors",
      "Content reformatting for answer-engine consumption",
    ],
    process: [
      { step: 1, title: "AI Visibility Audit", description: "We benchmark how often your brand, products, and key topics appear in AI Overviews, ChatGPT, and Perplexity answers." },
      { step: 2, title: "Entity & Schema Build", description: "We implement comprehensive structured data and build your Knowledge Graph entity so AI models can accurately represent your brand." },
      { step: 3, title: "Answer-First Content", description: "We reformat and create content specifically architected to be extracted and cited by large language models." },
      { step: 4, title: "Monitoring & Reporting", description: "We track AI citation frequency, brand mention sentiment, and search-feature real estate on a monthly basis." },
    ],
    technologies: ["Google AI Overviews", "ChatGPT", "Perplexity AI", "Schema.org", "Google Knowledge Graph", "GA4"],
    faqs: [
      { question: "What is AI Search Optimisation?", answer: "It is the practice of making your brand and content highly visible and accurately represented in AI-generated answers from tools like Google AI Overviews, ChatGPT, and Perplexity." },
      { question: "Is this the same as traditional SEO?", answer: "It builds on traditional SEO but adds new layers: entity building, structured data for AI consumption, answer-first content formatting, and direct monitoring of LLM citation share." },
      { question: "How do you measure success?", answer: "We track AI Overview inclusion rate, LLM brand citation frequency, share of AI-generated answers in your category, and downstream traffic from AI surfaces." },
    ],
  },
  {
    slug: "ppc",
    title: "Pay-Per-Click Advertising",
    shortDescription:
      "Generate instant, qualified leads with precision-targeted Google and Meta campaigns engineered for UAE businesses.",
    fullDescription:
      "Paid search is the fastest path from budget to booked revenue. In the UAE — where Google commands 97% search market share and CPCs in sectors like real estate and legal run high — the margin between a profitable campaign and a money pit comes down to architecture, audience strategy, and relentless optimisation. Our PPC service covers everything from campaign build to conversion attribution, engineered for the unique dynamics of the UAE digital advertising market.",
    category: "Paid Media",
    icon: "Target",
    benefits: [
      "Google Search, Shopping, Display, and Performance Max campaigns",
      "Meta and LinkedIn paid social for B2B and B2C",
      "Full conversion tracking via GA4 and Google Tag Manager",
      "Landing page creation and A/B testing",
      "Negative keyword management to eliminate wasted spend",
      "Monthly performance reviews with transparent cost-per-lead reporting",
    ],
    process: [
      { step: 1, title: "Account Audit", description: "We analyse your existing campaigns (or competitors' strategies if you're starting fresh) to identify every efficiency gain and growth opportunity." },
      { step: 2, title: "Campaign Architecture", description: "We build a granular campaign structure with tightly themed ad groups, custom audiences, and location targeting calibrated for UAE districts." },
      { step: 3, title: "Ad Creative & Copy", description: "Our copywriters produce high-converting ad text and creative assets optimised for UAE cultural context and search intent." },
      { step: 4, title: "Conversion Tracking", description: "We instrument every conversion point — calls, forms, WhatsApp, purchases — for accurate ROI measurement." },
      { step: 5, title: "Optimise & Scale", description: "Weekly bid adjustments, quality score improvements, and audience expansion keep your ROAS climbing month after month." },
    ],
    technologies: ["Google Ads", "Meta Ads", "LinkedIn Ads", "GA4", "Google Tag Manager", "Looker Studio"],
    faqs: [
      { question: "What is a realistic Google Ads budget for UAE?", answer: "Most B2B clients start with AED 10,000–20,000/month. E-commerce typically requires AED 15,000+ to generate meaningful data. We scale budgets as ROAS improves." },
      { question: "How quickly will I see results from PPC?", answer: "Qualified leads typically begin within the first week of launch. Full campaign optimisation takes 60–90 days as we accumulate conversion data." },
      { question: "Do you manage Meta (Facebook/Instagram) Ads too?", answer: "Yes — we run integrated Google + Meta campaigns for clients who want full paid media coverage, with unified reporting across both platforms." },
    ],
  },
  {
    slug: "social-media-marketing",
    title: "Social Media Marketing",
    shortDescription:
      "Build an audience that converts — with premium content, community management, and paid social strategies built for the UAE market.",
    fullDescription:
      "The UAE has one of the highest social media penetration rates in the world at 99%, with Instagram, TikTok, LinkedIn, and Snapchat all commanding huge audiences. Standing out demands more than a content calendar — it requires a sharp brand voice, culturally resonant creative, and a data-led paid amplification strategy. We handle every dimension of social media marketing so your brand becomes a category authority.",
    category: "Social Media",
    icon: "Share2",
    benefits: [
      "Full content strategy and editorial calendar",
      "Professional graphic design and video editing",
      "Community management and response handling",
      "Influencer identification and campaign management",
      "Paid social campaign management (Meta, TikTok, LinkedIn, Snapchat)",
      "Monthly analytics report with engagement and lead data",
    ],
    process: [
      { step: 1, title: "Brand & Audience Audit", description: "We analyse your current social presence, audience demographics, and top-performing competitor content to identify the fastest growth levers." },
      { step: 2, title: "Strategy & Content Pillars", description: "We define your brand voice, visual identity, and 4–6 content pillars that balance awareness, engagement, and conversion." },
      { step: 3, title: "Content Production", description: "Our UAE-based creative team produces scroll-stopping imagery, Reels, Stories, and carousel posts on a consistent publishing schedule." },
      { step: 4, title: "Community & Engagement", description: "We respond to comments and DMs within business hours, maintaining your brand reputation across every platform." },
      { step: 5, title: "Paid Amplification", description: "We amplify high-performing organic content with targeted paid distribution to grow reach and generate measurable leads." },
    ],
    technologies: ["Meta Business Suite", "TikTok Ads Manager", "LinkedIn Campaign Manager", "Canva Pro", "CapCut", "Sprout Social"],
    faqs: [
      { question: "Which social platforms should UAE businesses focus on?", answer: "Instagram and TikTok dominate B2C; LinkedIn is essential for B2B. WhatsApp Business is increasingly important for direct customer communication. We recommend starting with 2–3 platforms based on your audience." },
      { question: "How long before we see follower and engagement growth?", answer: "With consistent quality content and paid amplification, most accounts see meaningful growth within 60–90 days. Viral moments can accelerate this significantly." },
      { question: "Do you create content in Arabic?", answer: "Yes — we have native Arabic-speaking copywriters and designers who create bilingual content calibrated for UAE and GCC audiences." },
    ],
  },
  {
    slug: "web-design",
    title: "Web Design",
    shortDescription:
      "Award-calibre websites that convert visitors into customers — designed for UAE brands that demand the best.",
    fullDescription:
      "Your website is your highest-performing salesperson. A slow, generic, or confusing website loses you business every single day. Our web design service fuses conversion-rate optimisation principles with premium aesthetics to create sites that not only look exceptional but measurably drive enquiries, bookings, and purchases. Every project is built mobile-first, accessibility-compliant, and optimised for Core Web Vitals from day one.",
    category: "Design",
    icon: "Palette",
    benefits: [
      "Custom design — no templates, no shortcuts",
      "Conversion-rate optimisation built into every page",
      "Mobile-first, fully responsive across all devices",
      "Core Web Vitals score of 90+ guaranteed",
      "Bilingual (English/Arabic) design capability",
      "Full handover with training and documentation",
    ],
    process: [
      { step: 1, title: "Discovery & Strategy", description: "We map your customer journey, analyse competitor UX, and define the conversion goals that will shape every design decision." },
      { step: 2, title: "Wireframes & Architecture", description: "We build low-fidelity wireframes to agree on structure, navigation, and content hierarchy before any visual design begins." },
      { step: 3, title: "Visual Design", description: "Our designers craft pixel-perfect mockups in Figma, incorporating your brand identity and UAE market expectations." },
      { step: 4, title: "Development", description: "We build on your chosen CMS or framework, ensuring clean code, fast load times, and seamless integrations." },
      { step: 5, title: "Launch & Optimise", description: "Post-launch, we monitor heatmaps, session recordings, and conversion data to continuously improve performance." },
    ],
    technologies: ["Figma", "WordPress", "Webflow", "Next.js", "React", "Lighthouse"],
    faqs: [
      { question: "How long does a website project take?", answer: "A standard business website takes 6–10 weeks from kickoff to launch. E-commerce and complex web applications typically run 12–20 weeks." },
      { question: "Do you build on WordPress or custom frameworks?", answer: "Both — we recommend WordPress for content-heavy sites and marketing pages, and React/Next.js for web applications and high-performance landing pages." },
      { question: "Can you redesign our existing website without losing SEO rankings?", answer: "Absolutely — we implement comprehensive redirect mapping, preserve your existing URL structure where possible, and monitor rankings closely throughout the transition." },
    ],
  },
  {
    slug: "web-development",
    title: "Web Development",
    shortDescription:
      "High-performance web applications and custom integrations built by senior engineers who understand business outcomes.",
    fullDescription:
      "Great web development is invisible — it's fast, reliable, secure, and does exactly what the business needs without fanfare. Our development team builds everything from custom WordPress themes and complex WooCommerce stores to full React/Node.js web applications and API integrations. We work to enterprise engineering standards: version control, automated testing, staging environments, and proper deployment pipelines.",
    category: "Development",
    icon: "Code",
    benefits: [
      "Custom web application development (React, Next.js, Node.js)",
      "WordPress and WooCommerce development and customisation",
      "Third-party API and CRM integrations",
      "Performance engineering — sub-2s load times guaranteed",
      "Security hardening and penetration testing",
      "Ongoing maintenance and support contracts available",
    ],
    process: [
      { step: 1, title: "Requirements & Architecture", description: "We document functional requirements, design the data model, and select the right technology stack for your specific use case." },
      { step: 2, title: "Sprint Planning", description: "We break the project into 2-week sprints with clear deliverables so you see progress and can give feedback throughout." },
      { step: 3, title: "Development & Review", description: "Engineers build against agreed specs with daily commits to a staging environment you can review in real time." },
      { step: 4, title: "QA & Testing", description: "Every feature undergoes functional, cross-browser, and performance testing before it moves to production." },
      { step: 5, title: "Deploy & Support", description: "We launch on your preferred infrastructure and provide structured handover documentation plus ongoing support." },
    ],
    technologies: ["React", "Next.js", "Node.js", "WordPress", "WooCommerce", "PostgreSQL", "AWS", "Vercel"],
    faqs: [
      { question: "Do you work with existing codebases or only greenfield projects?", answer: "Both — we regularly take over legacy codebases, improve their architecture, and extend them with new features. We begin every engagement with a code audit." },
      { question: "What hosting do you recommend for UAE businesses?", answer: "We typically recommend AWS Middle East (UAE) region for latency-sensitive applications, or Cloudflare-backed Vercel/Netlify for frontend-heavy projects." },
      { question: "Can you integrate our website with our CRM or ERP?", answer: "Yes — we have experience integrating with Salesforce, HubSpot, SAP, Oracle, and bespoke internal systems via REST and GraphQL APIs." },
    ],
  },

  // ─── 7 New Services ─────────────────────────────────────────────────────────
  {
    slug: "shopify-development",
    title: "Shopify Development",
    shortDescription:
      "Launch and scale a high-converting Shopify store built for the UAE e-commerce market — from custom themes to complex integrations.",
    fullDescription:
      "Shopify powers over 4 million stores worldwide and is the platform of choice for fast-growing UAE e-commerce brands. But a stock Shopify theme rarely converts — it takes deep development expertise, conversion-rate thinking, and seamless integrations with regional payment gateways (Tabby, Tamara, PayFort) to build a store that genuinely performs. Our Shopify development team builds from scratch or optimises existing stores for maximum speed, usability, and revenue.",
    category: "E-Commerce",
    icon: "ShoppingBag",
    benefits: [
      "Custom Shopify theme development (Liquid + React)",
      "Shopify Plus migration and upgrade support",
      "UAE payment gateway integrations (Tabby, Tamara, Stripe, PayFort)",
      "Product catalogue setup, bulk import, and data migration",
      "App selection, installation, and custom Shopify app development",
      "Post-launch CRO: A/B testing, checkout optimisation, upsell flows",
    ],
    process: [
      { step: 1, title: "Discovery & UX Planning", description: "We audit your current store (or competitor stores) for conversion blockers and map out the ideal customer journey from product discovery to checkout." },
      { step: 2, title: "Design & Prototyping", description: "Our designers build high-fidelity Figma mockups of every key template — homepage, collection, product, cart — before a line of code is written." },
      { step: 3, title: "Theme Development", description: "We develop your custom theme in Shopify's Liquid templating engine with clean, documented code that your team can maintain." },
      { step: 4, title: "Integrations & Apps", description: "We connect your store to your ERP, CRM, email platform, loyalty programme, and regional payment gateways." },
      { step: 5, title: "QA, Launch & CRO", description: "Rigorous cross-device testing, a soft launch to catch edge cases, then ongoing conversion rate optimisation to keep revenue growing." },
    ],
    technologies: ["Shopify", "Shopify Plus", "Liquid", "React", "Tabby", "Tamara", "PayFort", "Klaviyo"],
    faqs: [
      { question: "Should I use Shopify or WooCommerce for my UAE store?", answer: "Shopify is generally the better choice for brands focused on growth — it handles hosting, security, and PCI compliance for you. WooCommerce offers more flexibility but requires more technical management." },
      { question: "Can you migrate my existing store to Shopify?", answer: "Yes — we handle full data migrations from WooCommerce, Magento, PrestaShop, and custom platforms, including products, customers, and order history." },
      { question: "Do you integrate Tabby and Tamara buy-now-pay-later?", answer: "Absolutely — BNPL is increasingly expected by UAE shoppers. We integrate both Tabby and Tamara and can advise on which performs better for your price point and category." },
      { question: "How much does a custom Shopify store cost?", answer: "Custom theme development typically starts at AED 25,000. Full-featured stores with custom integrations range from AED 40,000 to AED 120,000 depending on complexity." },
    ],
  },
  {
    slug: "laravel-development",
    title: "Laravel Development",
    shortDescription:
      "Robust, scalable PHP web applications built on Laravel — the framework powering thousands of enterprise-grade platforms.",
    fullDescription:
      "Laravel is the world's most popular PHP framework and the foundation of choice for complex web applications that demand reliability, security, and speed. Whether you need a custom SaaS portal, a multi-tenant marketplace, a workflow automation tool, or a bespoke CRM, our senior Laravel engineers deliver production-ready systems built to industry best practices — with comprehensive test coverage, clean architecture, and documentation your team can maintain.",
    category: "Development",
    icon: "Server",
    benefits: [
      "Custom Laravel application development from scratch",
      "API development (RESTful and GraphQL) with full documentation",
      "Multi-tenant SaaS application architecture",
      "Legacy PHP or CodeIgniter migration to modern Laravel",
      "Laravel Nova admin panel development",
      "Comprehensive test suites (Feature, Unit, Browser tests)",
    ],
    process: [
      { step: 1, title: "Architecture Design", description: "We design the database schema, API contracts, and application architecture before writing production code — saving costly refactors later." },
      { step: 2, title: "Agile Development", description: "We work in 2-week sprints, delivering testable features to a staging environment throughout development so you stay in control." },
      { step: 3, title: "Code Review & Standards", description: "Every pull request goes through peer review against our Laravel coding standards. We use PHPStan static analysis and Laravel Pint for code quality." },
      { step: 4, title: "Testing & QA", description: "We write automated feature and unit tests targeting 80%+ code coverage, plus manual QA on a staging server matching your production environment." },
      { step: 5, title: "Deployment & DevOps", description: "We configure CI/CD pipelines, set up server environments on AWS or DigitalOcean, and provide full runbook documentation." },
    ],
    technologies: ["Laravel", "PHP 8.3", "MySQL", "PostgreSQL", "Redis", "Livewire", "Inertia.js", "Laravel Horizon", "AWS"],
    faqs: [
      { question: "Why choose Laravel over other PHP frameworks?", answer: "Laravel's ecosystem (Eloquent ORM, Queues, Broadcasting, Horizon, Telescope) significantly reduces development time while enforcing clean, maintainable code. It also has the largest PHP talent pool globally." },
      { question: "Can you take over an existing Laravel application?", answer: "Yes — we perform a full codebase audit to assess architecture quality, security vulnerabilities, and technical debt before committing to a maintenance or enhancement engagement." },
      { question: "Do you provide ongoing Laravel maintenance?", answer: "Yes — we offer monthly retainer contracts covering security patches, Laravel version upgrades, performance monitoring, and feature development." },
      { question: "How long does a Laravel project take?", answer: "Simple applications (MVP scope) run 6–10 weeks. Complex multi-tenant platforms typically take 4–8 months. We scope every project in detail before starting." },
    ],
  },
  {
    slug: "saas-development",
    title: "SaaS Development",
    shortDescription:
      "Build your Software-as-a-Service product from concept to launch — with a team that understands recurring revenue architecture.",
    fullDescription:
      "Building a SaaS product is fundamentally different from building a website or a one-off application. Subscription billing, multi-tenancy, usage-based metering, onboarding flows, in-app analytics, and churn management are all first-class architectural concerns from day one. Our SaaS development team has shipped multiple successful products and brings that hard-won operational knowledge to your build — so you avoid the expensive mistakes most first-time SaaS founders make.",
    category: "Development",
    icon: "Cloud",
    benefits: [
      "Full-stack SaaS product development (React + Node.js / Laravel)",
      "Multi-tenant database architecture with row-level security",
      "Stripe Billing integration — subscriptions, usage metering, invoicing",
      "Role-based access control (RBAC) and team management",
      "In-app analytics, event tracking, and product telemetry",
      "Scalable infrastructure on AWS or GCP with auto-scaling",
    ],
    process: [
      { step: 1, title: "Product Scoping", description: "We work through your feature set, user personas, and monetisation model to produce a lean product spec covering the MVP and roadmap beyond it." },
      { step: 2, title: "Architecture & Tech Stack", description: "We design the tenancy model, database strategy, API layer, and frontend architecture — documented decisions you own from day one." },
      { step: 3, title: "MVP Development", description: "We build the core product loop first — the thing that delivers your primary value — before adding authentication, billing, and administration layers." },
      { step: 4, title: "Billing & Onboarding", description: "We integrate Stripe Billing, build your pricing page, onboarding flow, and trial management logic so you can start acquiring paying customers." },
      { step: 5, title: "Launch & Iteration", description: "We deploy your production environment, instrument product analytics, and support you through your first paying customer milestones." },
    ],
    technologies: ["React", "Next.js", "Node.js", "Laravel", "PostgreSQL", "Stripe", "AWS", "Terraform", "Segment"],
    faqs: [
      { question: "How much does it cost to build a SaaS product?", answer: "A well-scoped MVP typically costs AED 120,000–250,000 and takes 3–5 months. The exact figure depends heavily on integration complexity, number of user roles, and billing model sophistication." },
      { question: "Do you help with product strategy or just development?", answer: "Both — we work with founders at ideation stage to pressure-test product assumptions, scope the MVP precisely, and ensure the architecture supports the business model before writing code." },
      { question: "Can you build the SaaS and help us market it?", answer: "Yes — our agency provides full-stack support: product development, SEO for SaaS acquisition, PPC for sign-up growth, and content marketing to build category authority." },
      { question: "Who owns the code and IP?", answer: "You do — 100%. All source code, designs, and documentation are transferred to you at project completion under a full IP assignment agreement." },
    ],
  },
  {
    slug: "mobile-app-development",
    title: "Mobile App Development",
    shortDescription:
      "Cross-platform iOS and Android apps that users love — built with React Native for native performance without double the cost.",
    fullDescription:
      "Mobile is the primary screen for the UAE's digitally-native population, with smartphone penetration above 90%. A well-crafted mobile app deepens customer relationships, opens new revenue streams, and creates a defensible product moat that competitors struggle to replicate. We build cross-platform apps in React Native, delivering a truly native experience on both iOS and Android from a single codebase — cutting costs and time to market without compromising on quality.",
    category: "Development",
    icon: "Smartphone",
    benefits: [
      "React Native development for iOS and Android",
      "Native module integration for camera, biometrics, push notifications, maps",
      "App Store and Google Play submission and approval management",
      "Backend API development and real-time features (WebSockets)",
      "UI/UX design optimised for both iOS (HIG) and Android (Material) conventions",
      "Post-launch monitoring, crash reporting, and iterative updates",
    ],
    process: [
      { step: 1, title: "UX Research & Wireframes", description: "We map user journeys, define core features, and produce low-fidelity wireframes for stakeholder alignment before any design investment." },
      { step: 2, title: "UI Design", description: "Our designers build platform-native high-fidelity mockups in Figma, adhering to Apple HIG and Google Material guidelines for app store approval readiness." },
      { step: 3, title: "React Native Development", description: "We build your app with Expo + React Native, integrating native modules and third-party SDKs (maps, payments, analytics) cleanly and maintainably." },
      { step: 4, title: "Backend & APIs", description: "We develop or extend the backend APIs your app needs, with proper authentication, rate limiting, and data validation." },
      { step: 5, title: "Testing & Store Submission", description: "Comprehensive manual and automated testing across real iOS and Android devices, followed by App Store and Google Play submission." },
    ],
    technologies: ["React Native", "Expo", "TypeScript", "Node.js", "Firebase", "Stripe Mobile", "Apple Maps", "Google Maps"],
    faqs: [
      { question: "React Native vs native Swift/Kotlin — which is better for my project?", answer: "React Native is the right choice for 90% of business apps — it delivers native performance and access to device APIs while cutting cost and time to market by 40–60%. Choose native only if you need bleeding-edge platform features or extreme performance (e.g. AR gaming)." },
      { question: "How long does it take to build and launch a mobile app?", answer: "A focused MVP with core functionality typically takes 12–20 weeks from kickoff to app store approval. Apps with complex real-time features or hardware integrations run 24–32 weeks." },
      { question: "Do you handle App Store and Google Play submissions?", answer: "Yes — we manage the entire submission process including app store metadata, screenshots, privacy policy requirements, and any review feedback from Apple or Google." },
      { question: "Can you maintain and update our app after launch?", answer: "Yes — we offer monthly retainer support covering OS compatibility updates, security patches, crash monitoring, and feature development." },
    ],
  },
  {
    slug: "reputation-management",
    title: "Online Reputation Management",
    shortDescription:
      "Protect, build, and repair your brand's online reputation — so what Google shows when people search your name works for you, not against you.",
    fullDescription:
      "In the UAE, where trust and social proof are critical purchase drivers across both B2B and B2C markets, your online reputation directly impacts revenue. Negative reviews, damaging press, or a weak online profile all cost you business every day. Our Online Reputation Management service monitors, shapes, and protects what appears when people search for your brand — across Google, Trustpilot, Google Maps, LinkedIn, and UAE-specific review platforms.",
    category: "Reputation",
    icon: "Shield",
    benefits: [
      "24/7 brand mention monitoring across web, social, and review platforms",
      "Google My Business review management and response strategy",
      "Review acquisition campaigns to build a 5-star profile",
      "Negative content suppression and SERP shaping",
      "Crisis communications support and rapid response playbooks",
      "Monthly reputation health score report",
    ],
    process: [
      { step: 1, title: "Reputation Audit", description: "We conduct a full audit of your current online reputation: Google results, review platforms, social mentions, news, and forum discussions." },
      { step: 2, title: "Risk Assessment", description: "We identify your highest-priority reputation threats and opportunities — the issues that are costing you customers right now." },
      { step: 3, title: "Positive Content Strategy", description: "We create and publish authoritative positive content — press, profiles, case studies, and social proof — that outranks harmful material." },
      { step: 4, title: "Review Management", description: "We implement review acquisition workflows and professional response templates that turn your review profile into a conversion asset." },
      { step: 5, title: "Monitor & Maintain", description: "Ongoing monitoring with immediate alerts for negative mentions, monthly reporting, and continuous optimisation of your digital footprint." },
    ],
    technologies: ["Google Alerts", "Brand24", "Mention", "Trustpilot", "Google My Business", "Semrush", "BrightLocal"],
    faqs: [
      { question: "Can negative Google reviews be removed?", answer: "Reviews that violate Google's policies (fake, spam, off-topic, or containing personal information) can be flagged for removal. Legitimate negative reviews cannot be deleted, but we help craft professional responses that mitigate their impact and build a dominant positive profile." },
      { question: "How long does it take to repair a damaged reputation?", answer: "Simple cases — improving a weak review profile — typically show results within 60–90 days. Suppressing significant negative press or recovering from a crisis typically takes 6–12 months of sustained effort." },
      { question: "Do you help with Google Autocomplete and Related Searches?", answer: "Yes — managing what appears in Google's autocomplete and knowledge panels is a specialised element of our advanced reputation management service." },
      { question: "Is reputation management relevant for personal brands as well as businesses?", answer: "Very much so — we work with senior executives, entrepreneurs, and public figures in the UAE to build authoritative personal brand profiles and suppress unwanted search results." },
    ],
  },
  {
    slug: "google-business-profile",
    title: "Google Business Profile Optimisation",
    shortDescription:
      "Dominate local UAE search results and Google Maps with a fully optimised Google Business Profile that drives calls, visits, and enquiries.",
    fullDescription:
      "Google Business Profile (formerly Google My Business) is the single most powerful free tool for local business visibility in the UAE. An optimised GBP listing appears in the Local Pack — the map results at the top of local searches — and consistently drives more calls and direction requests than a website alone. Yet most UAE businesses have incomplete, unoptimised profiles that are actively losing them customers. We turn your GBP into a lead-generating asset.",
    category: "Local SEO",
    icon: "MapPin",
    benefits: [
      "Full GBP profile setup or audit and optimisation",
      "Google Maps ranking improvement for target service + location keywords",
      "Review acquisition strategy and response management",
      "Google Posts calendar with promotions, events, and updates",
      "Photo and video optimisation to increase profile engagement",
      "Monthly GBP insights reporting (calls, direction requests, website clicks)",
    ],
    process: [
      { step: 1, title: "Profile Audit", description: "We audit your current GBP listing against all 50+ ranking factors — completeness, category selection, NAP consistency, review velocity, and media quality." },
      { step: 2, title: "Full Optimisation", description: "We update every element of your profile: business name, categories, description, attributes, services, opening hours, Q&A, and media." },
      { step: 3, title: "Citation Building", description: "We build and clean citations across UAE business directories to reinforce your NAP (Name, Address, Phone) consistency — a key local ranking factor." },
      { step: 4, title: "Review Strategy", description: "We design and implement a review acquisition process that generates a consistent flow of 5-star reviews from happy customers." },
      { step: 5, title: "Ongoing Management", description: "Weekly Google Posts, review responses, Q&A management, and monthly performance reporting keep your profile active and ranking." },
    ],
    technologies: ["Google Business Profile", "BrightLocal", "Yext", "Google Maps", "Semrush Local", "Whitespark"],
    faqs: [
      { question: "How important is Google Business Profile for UAE businesses?", answer: "Critical — over 80% of UAE consumers check Google Maps before visiting a local business. Appearing in the Local Pack (top 3 map results) for your target keywords can double or triple your inbound enquiries." },
      { question: "Can you improve my Google Maps ranking for multiple locations?", answer: "Yes — we manage multi-location GBP strategies for businesses with branches across Dubai, Abu Dhabi, Sharjah, and other emirates, with location-specific optimisation for each." },
      { question: "How long does it take to rank in the Google Local Pack?", answer: "For low-competition local searches, improvements are visible within 4–8 weeks. Competitive categories in central Dubai typically require 3–6 months of sustained optimisation." },
      { question: "What if my business doesn't have a physical location?", answer: "Service-area businesses (SABs) can still rank on Google Maps without a visible address. We configure your GBP correctly for SAB status and optimise for the service areas you cover." },
    ],
  },
  {
    slug: "mvp-development",
    title: "MVP Development",
    shortDescription:
      "Go from idea to a live, testable product in 8–12 weeks — with a lean team that builds what matters and skips what doesn't.",
    fullDescription:
      "The most expensive mistake a founder can make is building the wrong product in full. Our MVP Development service is engineered to minimise that risk: we work with you to define the smallest possible product that delivers your core value proposition, build it rapidly with production-quality code, and get it in front of real users — so you can validate assumptions, gather data, and raise investment with something real in hand. We've helped UAE and GCC startups go from napkin sketch to funded company.",
    category: "Startups",
    icon: "Rocket",
    benefits: [
      "Structured product scoping workshop — feature prioritisation and MVP definition",
      "High-fidelity prototype in Figma for investor presentations",
      "Full-stack MVP development (React + Node.js or React Native)",
      "User authentication, payments, and core feature implementation",
      "Deployment on scalable cloud infrastructure ready for growth",
      "3 months post-launch support and iteration included",
    ],
    process: [
      { step: 1, title: "Idea Validation Workshop", description: "We run a structured workshop to challenge your assumptions, identify your riskiest hypotheses, and define the smallest testable product that proves your concept." },
      { step: 2, title: "Prototype & User Stories", description: "We produce a clickable Figma prototype and full user story backlog — the blueprint for every build decision and a powerful tool for early customer conversations." },
      { step: 3, title: "Sprint 0: Architecture", description: "We set up the development environment, CI/CD pipeline, database schema, and API contracts before the first feature sprint begins." },
      { step: 4, title: "Rapid Build Sprints", description: "4–6 two-week sprints delivering working software to a staging URL. You review, give feedback, and we iterate — no black boxes." },
      { step: 5, title: "Launch & Learn", description: "We deploy your MVP to production, instrument analytics, and support your first real-user testing so you can make data-backed decisions about what to build next." },
    ],
    technologies: ["React", "Next.js", "React Native", "Node.js", "PostgreSQL", "Stripe", "Vercel", "AWS", "Figma"],
    faqs: [
      { question: "What exactly is an MVP?", answer: "A Minimum Viable Product is the simplest version of your product that delivers its core value to real users. It is not a prototype — it is production-quality software with a deliberately narrow feature set, designed to test your most critical assumptions quickly." },
      { question: "How is MVP development priced?", answer: "We offer fixed-scope MVP packages starting at AED 85,000 for web MVPs and AED 120,000 for mobile apps, covering product scoping, design, development, and launch. Complex platforms are scoped individually." },
      { question: "Can you help us raise funding with the MVP?", answer: "Yes — we include investor-ready presentation materials (Figma prototype, technical architecture overview, roadmap deck) as part of every MVP engagement, and can support you through technical due diligence with investors." },
      { question: "What happens after the MVP launches?", answer: "We include 3 months of post-launch support. Many clients continue with us for Series A product development — scaling the MVP into a full product with a growing team." },
    ],
  },
];

async function seedServices() {
  console.log("Seeding services…");

  for (const service of services) {
    await db
      .insert(servicesTable)
      .values(service)
      .onConflictDoUpdate({
        target: servicesTable.slug,
        set: {
          title: sql`excluded.title`,
          shortDescription: sql`excluded.short_description`,
          fullDescription: sql`excluded.full_description`,
          category: sql`excluded.category`,
          icon: sql`excluded.icon`,
          benefits: sql`excluded.benefits`,
          process: sql`excluded.process`,
          technologies: sql`excluded.technologies`,
          faqs: sql`excluded.faqs`,
        },
      });
  }

  console.log(`  ✓ Upserted ${services.length} services`);
  console.log("Done.");
  process.exit(0);
}

seedServices().catch((err) => {
  console.error(err);
  process.exit(1);
});
