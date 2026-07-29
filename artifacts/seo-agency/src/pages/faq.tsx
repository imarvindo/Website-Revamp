import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Link } from "wouter";
import { ChevronDown, Search, MessageCircle, ArrowRight } from "lucide-react";
import { Button } from "@/components/ui/button";

interface FAQItem {
  q: string;
  a: string;
}

interface FAQCategory {
  label: string;
  icon: string;
  items: FAQItem[];
}

const FAQS: FAQCategory[] = [
  {
    label: "General SEO",
    icon: "🔍",
    items: [
      {
        q: "How long does it take to see results from SEO?",
        a: "SEO is a compounding investment. Most clients see measurable ranking improvements within 3–4 months. Significant traffic and revenue impact typically follows at the 6–9 month mark. Competitive industries or new domains may take longer. We set realistic milestones in your first strategy session so you always know exactly what to expect and when.",
      },
      {
        q: "What makes SEO.ae different from other Dubai agencies?",
        a: "Most agencies in the UAE focus on surface-level tactics — keyword stuffing, cheap links, and monthly reports full of vanity metrics. We operate differently: we treat your website as a programmable revenue engine, using enterprise-grade technical audits, AI-assisted content strategy, and precision link building. Every deliverable is tied to your business KPIs, not just rankings.",
      },
      {
        q: "Do you work with businesses outside of Dubai?",
        a: "Yes. While our headquarters is in Deira, Dubai, we serve clients across the UAE (Abu Dhabi, Sharjah, Ajman), GCC (Saudi Arabia, Qatar, Kuwait), and internationally. Our team is fully remote-capable and experienced with multi-market, multi-language SEO campaigns.",
      },
      {
        q: "Can SEO really work for my industry?",
        a: "Absolutely. We've delivered results for real estate, hospitality, e-commerce, healthcare, legal, SaaS, finance, and more. Every industry has search demand — the question is whether you're capturing it. If your customers use Google (and they do), SEO can drive qualified leads to your business.",
      },
      {
        q: "Is SEO still worth it with AI Overviews and ChatGPT?",
        a: "More than ever. AI search tools still pull answers from trusted, well-optimised websites. We additionally offer LLM Optimisation (LLMO) — making your brand appear as a cited source inside ChatGPT, Gemini, and Perplexity responses. The businesses investing in SEO now will own the AI era.",
      },
    ],
  },
  {
    label: "Our Services",
    icon: "⚙️",
    items: [
      {
        q: "What SEO services do you offer?",
        a: "We offer the full spectrum: Enterprise SEO (technical, on-page, off-page), AI Search Optimisation (LLM/GEO), PPC & Google Ads management, Social Media Marketing, Premium Web Design, and Web Development. Most clients start with an SEO audit and we scope from there.",
      },
      {
        q: "Do you offer one-off projects or only retainers?",
        a: "Both. We offer one-off technical audits, site migrations, and penalty recovery engagements. For ongoing growth, monthly retainers deliver the best compounding returns. We'll recommend the right engagement model based on your goals and budget in the free audit.",
      },
      {
        q: "Can you handle Google Ads and SEO together?",
        a: "Yes, and combining both is one of our highest-ROI approaches. Paid search gives you immediate visibility while organic SEO compounds over time. Our team manages both under one roof, sharing keyword data and audience insights between channels to maximise total search coverage.",
      },
      {
        q: "Do you build websites as well?",
        a: "Yes. Our Web Design and Development team builds conversion-optimised websites on WordPress, Webflow, Shopify, and custom React/Next.js stacks. Critically, everything we build is engineered for SEO from day one — correct site structure, fast Core Web Vitals, clean schema markup, and CMS-editable content.",
      },
      {
        q: "What is LLM Optimisation and do I need it?",
        a: "LLM Optimisation (also called Generative Engine Optimisation / GEO) is the practice of making your brand appear as a cited source when AI tools like ChatGPT, Gemini, Perplexity, and Google's AI Overviews answer questions in your industry. If your customers are using AI assistants to find services, you need LLMO. We recommend it for all serious brands.",
      },
    ],
  },
  {
    label: "Pricing & Contracts",
    icon: "💰",
    items: [
      {
        q: "How much does SEO cost?",
        a: "SEO retainers start from AED 3,000/month for local campaigns and scale to AED 30,000+/month for enterprise multi-market programmes. Pricing depends on your current website health, competition level, goals, and scope. The free audit gives us the data to propose an accurate, transparent package — no hidden fees.",
      },
      {
        q: "Do you require long-term contracts?",
        a: "We work on 6-month initial agreements (the minimum time needed to see meaningful organic results), after which we move to rolling monthly arrangements. We don't believe in locking clients in — we keep clients because we deliver results.",
      },
      {
        q: "What's included in the free SEO audit?",
        a: "Our free audit is a genuine 360° analysis, not a tool-generated PDF. It covers: technical health score, Core Web Vitals, crawl issues, keyword gap analysis, backlink profile, on-page optimisation score, competitor benchmarking, and a prioritised action plan. It typically takes 5–7 working days and comes with a strategy call.",
      },
      {
        q: "Is there a minimum budget for Google Ads management?",
        a: "We recommend a minimum ad spend of AED 5,000/month to run statistically meaningful campaigns. Our management fee is separate and scales with complexity. We're transparent about the split between our fee and your ad spend from day one.",
      },
    ],
  },
  {
    label: "Technical SEO",
    icon: "🛠️",
    items: [
      {
        q: "What is a technical SEO audit?",
        a: "A technical SEO audit is a deep inspection of your website's infrastructure — how Google crawls and indexes your site, site speed (Core Web Vitals), structured data (schema markup), internal linking, canonical tags, hreflang, duplicate content, XML sitemaps, robots.txt, and security (HTTPS). We use enterprise tools plus manual expert review to find every issue costing you rankings.",
      },
      {
        q: "My website has a Google penalty. Can you help?",
        a: "Yes. We handle both manual penalties (issued by Google reviewers) and algorithmic penalties (caused by updates like Panda, Penguin, or Helpful Content). Recovery starts with a thorough audit to identify the root cause, followed by a link disavow process and/or content remediation. Most penalties can be recovered within 2–4 months with the right strategy.",
      },
      {
        q: "What are Core Web Vitals and why do they matter?",
        a: "Core Web Vitals are Google's page experience metrics: Largest Contentful Paint (LCP) measures loading speed, Interaction to Next Paint (INP) measures responsiveness, and Cumulative Layout Shift (CLS) measures visual stability. Google uses these as ranking signals. Poor Core Web Vitals scores actively suppress your rankings, especially on mobile. We optimise all three.",
      },
      {
        q: "Do you optimise for Arabic search as well?",
        a: "Yes. The UAE has a significant Arabic-language search audience. We offer bilingual SEO campaigns covering both English and Arabic keywords, Arabic content creation by native speakers, and hreflang implementation to serve the right language to the right user. This is a competitive advantage that many agencies in the region overlook.",
      },
    ],
  },
  {
    label: "Reporting & Communication",
    icon: "📊",
    items: [
      {
        q: "How do you report on progress?",
        a: "You receive a custom live dashboard (Google Looker Studio) updated daily, plus a detailed monthly report that maps every activity to business outcomes — not just rankings. Reports include keyword movements, traffic trends, leads generated, conversion data, link acquisition, and a clear roadmap for the next 30 days.",
      },
      {
        q: "Who will be working on my account?",
        a: "Every client is assigned a dedicated Account Strategist, a Technical SEO Lead, and a Content Manager. You'll have a single point of contact for all communication and a direct line to the specialists working on your campaign. No account managers who are just intermediaries.",
      },
      {
        q: "How often will we have strategy calls?",
        a: "Monthly strategy calls are standard. Enterprise clients receive bi-weekly check-ins. Urgent matters are handled within 24 hours via WhatsApp or email. We also hold a comprehensive quarterly business review (QBR) to align your SEO strategy with broader business objectives.",
      },
      {
        q: "Can I see what you're doing on my website?",
        a: "Yes, full transparency. You have read access to our project management system where every task, its status, and the reasoning behind it is documented. You also retain ownership of your Google Analytics, Search Console, and all deliverables at all times.",
      },
    ],
  },
];

function FAQAccordion({ items }: { items: FAQItem[] }) {
  const [open, setOpen] = useState<number | null>(null);

  return (
    <div className="space-y-3">
      {items.map((item, i) => (
        <div
          key={i}
          className="rounded-2xl border transition-all duration-300 overflow-hidden"
          style={{
            borderColor: open === i ? "rgba(22,177,212,0.4)" : "hsl(var(--border))",
            background: open === i ? "rgba(22,177,212,0.04)" : "hsl(var(--card))",
          }}
        >
          <button
            onClick={() => setOpen(open === i ? null : i)}
            className="w-full flex items-center justify-between gap-4 px-6 py-5 text-left"
          >
            <span className="font-bold text-foreground text-base leading-snug pr-4">{item.q}</span>
            <ChevronDown
              className="w-5 h-5 shrink-0 transition-transform duration-300"
              style={{
                color: "#16B1D4",
                transform: open === i ? "rotate(180deg)" : "rotate(0deg)",
              }}
            />
          </button>
          <AnimatePresence>
            {open === i && (
              <motion.div
                initial={{ height: 0, opacity: 0 }}
                animate={{ height: "auto", opacity: 1 }}
                exit={{ height: 0, opacity: 0 }}
                transition={{ duration: 0.3, ease: [0.32, 0.72, 0, 1] }}
              >
                <p className="px-6 pb-6 text-muted-foreground leading-relaxed text-base">
                  {item.a}
                </p>
              </motion.div>
            )}
          </AnimatePresence>
        </div>
      ))}
    </div>
  );
}

export default function FAQ() {
  const [activeCategory, setActiveCategory] = useState(0);
  const [search, setSearch] = useState("");

  const filtered = search.trim()
    ? FAQS.map((cat) => ({
        ...cat,
        items: cat.items.filter(
          (item) =>
            item.q.toLowerCase().includes(search.toLowerCase()) ||
            item.a.toLowerCase().includes(search.toLowerCase())
        ),
      })).filter((cat) => cat.items.length > 0)
    : [FAQS[activeCategory]];

  const totalQuestions = FAQS.reduce((acc, cat) => acc + cat.items.length, 0);

  return (
    <div className="flex flex-col min-h-screen">
      {/* Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="absolute top-0 right-0 w-[500px] h-[500px] rounded-full opacity-10 blur-3xl pointer-events-none"
          style={{ background: "radial-gradient(circle, #16B1D4, transparent 70%)" }} />
        <div className="container mx-auto px-4 text-center relative z-10 max-w-3xl">
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-6"
            style={{ background: "rgba(22,177,212,0.15)", border: "1px solid rgba(22,177,212,0.3)" }}>
            <span className="text-xs font-black uppercase tracking-widest" style={{ color: "#16B1D4" }}>
              {totalQuestions} Questions Answered
            </span>
          </div>
          <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
            Frequently Asked<br />
            <span style={{
              background: "linear-gradient(135deg, #16B1D4, #7dd8ef)",
              WebkitBackgroundClip: "text",
              WebkitTextFillColor: "transparent",
              backgroundClip: "text",
            }}>Questions</span>
          </h1>
          <p className="text-xl text-white/70 mb-10 leading-relaxed font-light">
            Everything you need to know about SEO, our services, pricing, and what it's like to work with us.
          </p>

          {/* Search */}
          <div className="relative max-w-xl mx-auto">
            <Search className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40 pointer-events-none" />
            <input
              type="text"
              placeholder="Search questions…"
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              className="w-full pl-12 pr-6 py-4 rounded-2xl text-base outline-none transition-all"
              style={{
                background: "rgba(255,255,255,0.08)",
                border: "1px solid rgba(22,177,212,0.3)",
                color: "#fff",
              }}
            />
          </div>
        </div>
      </section>

      {/* FAQ body */}
      <section className="py-20 bg-background">
        <div className="container mx-auto px-4">
          {search.trim() ? (
            /* Search results */
            <div className="max-w-3xl mx-auto space-y-12">
              {filtered.length === 0 ? (
                <div className="text-center py-20 text-muted-foreground">
                  <p className="text-xl font-medium mb-3">No results found for "{search}"</p>
                  <p>Try a different keyword, or <Link href="/contact" className="text-primary underline">ask us directly</Link>.</p>
                </div>
              ) : (
                filtered.map((cat) => (
                  <div key={cat.label}>
                    <h2 className="text-xl font-bold text-foreground mb-4 flex items-center gap-2">
                      <span>{cat.icon}</span> {cat.label}
                    </h2>
                    <FAQAccordion items={cat.items} />
                  </div>
                ))
              )}
            </div>
          ) : (
            /* Category tabs + accordion */
            <div className="max-w-5xl mx-auto">
              <div className="grid lg:grid-cols-4 gap-8">
                {/* Sidebar tabs */}
                <nav className="lg:col-span-1">
                  <p className="text-xs font-bold uppercase tracking-widest text-muted-foreground mb-4">Categories</p>
                  <ul className="space-y-1.5">
                    {FAQS.map((cat, i) => (
                      <li key={i}>
                        <button
                          onClick={() => setActiveCategory(i)}
                          className="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-left transition-all duration-200"
                          style={{
                            background: activeCategory === i ? "rgba(22,177,212,0.1)" : "transparent",
                            color: activeCategory === i ? "#16B1D4" : "hsl(var(--foreground))",
                            border: activeCategory === i ? "1px solid rgba(22,177,212,0.3)" : "1px solid transparent",
                          }}
                        >
                          <span>{cat.icon}</span>
                          <span>{cat.label}</span>
                          <span className="ml-auto text-xs rounded-full px-2 py-0.5"
                            style={{ background: "hsl(var(--muted))", color: "hsl(var(--muted-foreground))" }}>
                            {cat.items.length}
                          </span>
                        </button>
                      </li>
                    ))}
                  </ul>
                </nav>

                {/* Accordion */}
                <div className="lg:col-span-3">
                  <motion.div
                    key={activeCategory}
                    initial={{ opacity: 0, y: 12 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.25 }}
                  >
                    <h2 className="text-2xl font-extrabold text-foreground mb-6 flex items-center gap-2">
                      <span>{FAQS[activeCategory].icon}</span>
                      {FAQS[activeCategory].label}
                    </h2>
                    <FAQAccordion items={FAQS[activeCategory].items} />
                  </motion.div>
                </div>
              </div>
            </div>
          )}
        </div>
      </section>

      {/* Still have questions CTA */}
      <section className="py-20 bg-muted/30 border-t border-border">
        <div className="container mx-auto px-4">
          <div className="max-w-3xl mx-auto rounded-3xl p-10 text-center"
            style={{
              background: "linear-gradient(135deg, #101A6A 0%, #0d1535 100%)",
              boxShadow: "0 20px 60px rgba(16,26,106,0.3)",
            }}>
            <div className="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-6"
              style={{ background: "rgba(22,177,212,0.2)", border: "1px solid rgba(22,177,212,0.3)" }}>
              <MessageCircle className="w-7 h-7" style={{ color: "#16B1D4" }} />
            </div>
            <h2 className="text-3xl font-extrabold text-white mb-3">Still have questions?</h2>
            <p className="text-white/60 mb-8 text-lg leading-relaxed">
              Our strategy team is happy to answer anything — from pricing to technical deep-dives.
              Get in touch and we'll respond within one business day.
            </p>
            <div className="flex flex-col sm:flex-row justify-center gap-4">
              <Link href="/contact">
                <Button size="lg" className="h-13 px-8 gap-2 font-bold w-full sm:w-auto"
                  style={{ background: "#16B1D4", color: "#fff" }}>
                  Contact Us <ArrowRight className="w-5 h-5" />
                </Button>
              </Link>
              <Link href="/contact">
                <Button size="lg" variant="inverted" className="h-13 px-8 font-bold w-full sm:w-auto">
                  Get Free Audit
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
