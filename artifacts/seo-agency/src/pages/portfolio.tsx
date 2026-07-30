import { useState } from "react";
import { useListPortfolioItems } from "@workspace/api-client-react";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { ExternalLink, ArrowRight, TrendingUp, Users, Award, Zap } from "lucide-react";
import { motion, AnimatePresence } from "framer-motion";
import { Button } from "@/components/ui/button";
import { Link } from "wouter";

const CATEGORIES = ["All", "SEO", "PPC", "Social Media", "Web Design"] as const;
type Category = (typeof CATEGORIES)[number];

const CATEGORY_DESCRIPTIONS: Record<Category, string> = {
  All: "Every discipline, every industry — our complete body of work.",
  SEO: "Organic search strategies that compound over time and outrank the competition.",
  PPC: "Paid campaigns engineered for maximum ROAS across Google, Meta, and beyond.",
  "Social Media": "Brand-building and lead generation across the platforms your audience uses.",
  "Web Design": "High-performance digital experiences designed to convert visitors into customers.",
};

const STATS = [
  { icon: TrendingUp, value: "312%", label: "Avg. Traffic Growth" },
  { icon: Award,      value: "8.2×",  label: "Avg. ROAS Delivered" },
  { icon: Users,      value: "50+",   label: "UAE Brands Scaled"   },
  { icon: Zap,        value: "94",    label: "Avg. Core Web Vitals" },
];

export default function Portfolio() {
  const { data: items, isLoading } = useListPortfolioItems();
  const [activeCategory, setActiveCategory] = useState<Category>("All");

  const filtered = items?.filter(
    (item) => activeCategory === "All" || item.category === activeCategory
  ) ?? [];

  const featured = filtered[0] ?? null;
  const rest = filtered.slice(1);

  return (
    <div className="flex flex-col min-h-screen bg-background">

      {/* ── Dark Hero ─────────────────────────────────────────────────── */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="container mx-auto px-4 text-center max-w-4xl relative z-10">
          <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }}>
            <div className="section-label bg-white/10 text-white border-white/20 mb-6">Our Work</div>
            <h1 className="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
              Built to <span className="gradient-text-primary">Perform</span>
            </h1>
            <p className="text-xl text-white/80 mb-10 font-light leading-relaxed max-w-2xl mx-auto">
              Every project is engineered around one objective — measurable growth. Browse our work across SEO, paid media, social, and web design.
            </p>
          </motion.div>
        </div>

        {/* Stats bar */}
        <div className="container mx-auto px-4 max-w-5xl relative z-10 mt-4">
          <motion.div
            className="grid grid-cols-2 md:grid-cols-4 gap-4"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.2 }}
          >
            {STATS.map(({ icon: Icon, value, label }) => (
              <div key={label} className="glass-panel-dark rounded-2xl p-6 text-center">
                <Icon className="w-6 h-6 text-accent mx-auto mb-3" />
                <div className="text-3xl font-black text-white mb-1">{value}</div>
                <div className="text-xs font-bold text-white/60 uppercase tracking-wider">{label}</div>
              </div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* ── Category Filters + Grid ────────────────────────────────────── */}
      <section className="py-24 bg-dot-pattern">
        <div className="container mx-auto px-4">

          {/* Filter tabs */}
          <motion.div
            className="flex flex-wrap gap-3 justify-center mb-14"
            initial={{ opacity: 0, y: 12 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, delay: 0.1 }}
          >
            {CATEGORIES.map((cat) => (
              <button
                key={cat}
                onClick={() => setActiveCategory(cat)}
                className={`
                  px-6 py-2.5 rounded-full text-sm font-bold border transition-all duration-200
                  ${activeCategory === cat
                    ? "bg-primary text-white border-primary shadow-md"
                    : "bg-white text-foreground border-border hover:border-primary/50 hover:text-primary"
                  }
                `}
              >
                {cat}
              </button>
            ))}
          </motion.div>

          {/* Category description */}
          <AnimatePresence mode="wait">
            <motion.p
              key={activeCategory}
              className="text-center text-muted-foreground text-base mb-14 max-w-xl mx-auto"
              initial={{ opacity: 0, y: 6 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: -6 }}
              transition={{ duration: 0.25 }}
            >
              {CATEGORY_DESCRIPTIONS[activeCategory]}
            </motion.p>
          </AnimatePresence>

          {/* Loading skeletons */}
          {isLoading && (
            <div className="space-y-10">
              <Skeleton className="h-[420px] rounded-3xl bg-muted w-full" />
              <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {[1, 2, 3, 4, 5, 6].map(i => (
                  <Skeleton key={i} className="h-80 rounded-2xl bg-muted" />
                ))}
              </div>
            </div>
          )}

          {/* Empty state */}
          {!isLoading && filtered.length === 0 && (
            <AnimatePresence>
              <motion.div
                className="text-center py-28"
                initial={{ opacity: 0, scale: 0.97 }}
                animate={{ opacity: 1, scale: 1 }}
                exit={{ opacity: 0 }}
                transition={{ duration: 0.3 }}
              >
                <div className="w-20 h-20 bg-muted rounded-3xl flex items-center justify-center mx-auto mb-6">
                  <Award className="w-10 h-10 text-primary/60" />
                </div>
                <h3 className="text-2xl font-bold text-foreground mb-3">
                  {activeCategory === "All"
                    ? "Portfolio Coming Soon"
                    : `No ${activeCategory} Projects Yet`}
                </h3>
                <p className="text-muted-foreground text-base max-w-sm mx-auto mb-8">
                  {activeCategory === "All"
                    ? "We're building out this portfolio. In the meantime, our case studies show exactly what we deliver."
                    : `We haven't published a ${activeCategory} case study here yet, but our team delivers results across every channel.`}
                </p>
                <Link href="/case-studies">
                  <Button variant="outline" className="gap-2">
                    View Case Studies <ArrowRight className="w-4 h-4" />
                  </Button>
                </Link>
              </motion.div>
            </AnimatePresence>
          )}

          {/* Featured spotlight */}
          {!isLoading && featured && (
            <AnimatePresence mode="wait">
              <motion.div
                key={`featured-${activeCategory}`}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, y: -10 }}
                transition={{ duration: 0.4 }}
                className="mb-12"
              >
                <div className="text-xs font-black text-primary uppercase tracking-widest mb-5 flex items-center gap-2">
                  <span className="inline-block w-8 h-px bg-primary" />
                  Featured Project
                </div>
                <Card className="group overflow-hidden bg-white border-border hover:border-primary/40 hover:shadow-2xl transition-all duration-500 rounded-3xl">
                  <div className="grid md:grid-cols-2 min-h-[420px]">
                    {/* Image panel */}
                    <div className="relative bg-muted overflow-hidden min-h-[280px] md:min-h-0">
                      {featured.imageUrl ? (
                        <img
                          src={featured.imageUrl}
                          alt={featured.title}
                          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 absolute inset-0"
                        />
                      ) : (
                        <div className="absolute inset-0 flex items-end justify-start p-10 bg-gradient-to-br from-secondary via-secondary/90 to-primary/60">
                          <div>
                            <div className="text-xs font-black text-accent uppercase tracking-widest mb-3">
                              {featured.category}
                            </div>
                            <h2 className="text-3xl font-black text-white leading-tight max-w-xs">
                              {featured.title}
                            </h2>
                          </div>
                        </div>
                      )}
                      <div className="absolute inset-0 bg-secondary/10 opacity-0 group-hover:opacity-100 transition-opacity" />
                    </div>

                    {/* Content panel */}
                    <div className="p-10 flex flex-col justify-between">
                      <div>
                        <div className="text-xs font-black text-accent uppercase tracking-widest mb-4">
                          {featured.category}
                        </div>
                        <h2 className="text-3xl md:text-4xl font-black text-foreground mb-2 leading-tight">
                          {featured.title}
                        </h2>
                        <p className="text-sm font-bold text-muted-foreground mb-5 uppercase tracking-wider">
                          {featured.client}
                        </p>
                        <p className="text-muted-foreground text-base leading-relaxed mb-8">
                          {featured.description}
                        </p>
                        <div className="flex flex-wrap gap-2 mb-8">
                          {featured.technologies.map(tech => (
                            <span key={tech} className="text-xs px-3 py-1.5 bg-muted rounded-md text-muted-foreground font-medium">
                              {tech}
                            </span>
                          ))}
                        </div>
                      </div>
                      <div className="flex items-center gap-4">
                        {featured.projectUrl && (
                          <a
                            href={featured.projectUrl}
                            target="_blank"
                            rel="noopener noreferrer"
                          >
                            <Button variant="outline" className="gap-2">
                              View Live <ExternalLink className="w-4 h-4" />
                            </Button>
                          </a>
                        )}
                        <Link href="/contact">
                          <Button className="gap-2">
                            Start Your Project <ArrowRight className="w-4 h-4" />
                          </Button>
                        </Link>
                      </div>
                    </div>
                  </div>
                </Card>
              </motion.div>
            </AnimatePresence>
          )}

          {/* Remaining projects grid */}
          {!isLoading && rest.length > 0 && (
            <AnimatePresence mode="wait">
              <motion.div
                key={`grid-${activeCategory}`}
                className="grid md:grid-cols-2 lg:grid-cols-3 gap-8"
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                transition={{ duration: 0.3 }}
              >
                {rest.map((item, i) => (
                  <motion.div
                    key={item.id}
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ delay: i * 0.07 }}
                  >
                    <Card className="group overflow-hidden bg-white border-border shadow-sm hover:shadow-xl hover:border-primary/40 transition-all duration-300 rounded-2xl h-full flex flex-col">
                      <div className="aspect-[4/3] relative overflow-hidden bg-muted">
                        {item.imageUrl ? (
                          <img
                            src={item.imageUrl}
                            alt={item.title}
                            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                          />
                        ) : (
                          <div className="w-full h-full flex items-end justify-start p-6 bg-gradient-to-br from-secondary/90 via-secondary/80 to-primary/50">
                            <span className="text-white/90 font-bold text-lg leading-snug">{item.title}</span>
                          </div>
                        )}
                        <div className="absolute inset-0 bg-secondary/10 opacity-0 group-hover:opacity-100 transition-opacity" />
                        {item.projectUrl && (
                          <a
                            href={item.projectUrl}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="absolute top-4 right-4 w-11 h-11 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-primary text-secondary hover:text-white shadow-lg"
                          >
                            <ExternalLink className="w-4 h-4" />
                          </a>
                        )}
                      </div>
                      <div className="p-7 flex flex-col flex-1">
                        <div className="text-xs font-black text-accent uppercase tracking-wider mb-3">
                          {item.category}
                        </div>
                        <h3 className="text-xl font-bold text-foreground mb-2 group-hover:text-primary transition-colors leading-snug">
                          {item.title}
                        </h3>
                        <p className="text-xs font-bold text-muted-foreground uppercase tracking-wider mb-3">
                          {item.client}
                        </p>
                        <p className="text-sm text-muted-foreground mb-5 line-clamp-3 flex-1 leading-relaxed">
                          {item.description}
                        </p>
                        <div className="flex flex-wrap gap-2 mt-auto">
                          {item.technologies.slice(0, 3).map(tech => (
                            <span key={tech} className="text-xs px-3 py-1.5 bg-muted rounded-md text-muted-foreground font-medium">
                              {tech}
                            </span>
                          ))}
                        </div>
                      </div>
                    </Card>
                  </motion.div>
                ))}
              </motion.div>
            </AnimatePresence>
          )}

        </div>
      </section>

      {/* ── Approach Strip ─────────────────────────────────────────────── */}
      {!isLoading && filtered.length > 0 && (
        <section className="py-20 bg-white border-y border-border">
          <div className="container mx-auto px-4 max-w-5xl">
            <div className="text-center mb-14">
              <div className="section-label mb-5">Our Philosophy</div>
              <h2 className="text-3xl md:text-4xl font-extrabold text-foreground">
                How We Approach Every Project
              </h2>
            </div>
            <div className="grid md:grid-cols-3 gap-8">
              {[
                {
                  step: "01",
                  title: "Data Before Design",
                  body: "Every brief starts with data — market analysis, competitor research, and keyword demand mapping before a single pixel is placed or a campaign is launched.",
                },
                {
                  step: "02",
                  title: "Conversion-First Execution",
                  body: "Aesthetics serve a purpose: driving measurable action. We validate every major decision against conversion impact, not just visual preference.",
                },
                {
                  step: "03",
                  title: "Transparent Reporting",
                  body: "Monthly performance reviews with clear attribution. You always know exactly what's working, what's next, and what your return on investment is.",
                },
              ].map(({ step, title, body }) => (
                <motion.div
                  key={step}
                  className="text-center px-4"
                  initial={{ opacity: 0, y: 16 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ duration: 0.4 }}
                >
                  <div className="text-5xl font-black text-primary/15 mb-3">{step}</div>
                  <h3 className="text-lg font-bold text-foreground mb-3">{title}</h3>
                  <p className="text-muted-foreground text-sm leading-relaxed">{body}</p>
                </motion.div>
              ))}
            </div>
          </div>
        </section>
      )}

      {/* ── Dark CTA ───────────────────────────────────────────────────── */}
      <section className="py-24 hero-dark bg-grid-pattern-dark text-center mt-auto">
        <div className="container mx-auto px-4 max-w-3xl">
          <motion.div initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }}>
            <h2 className="text-4xl md:text-5xl font-bold text-white mb-5">
              Ready to Join Our Portfolio?
            </h2>
            <p className="text-lg text-white/80 mb-10 font-light leading-relaxed max-w-xl mx-auto">
              Let's build a strategy around your growth goals — with the same rigour and transparency you've seen here.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link href="/contact">
                <Button size="lg" className="h-14 px-10 text-lg">
                  Start Your Project
                </Button>
              </Link>
              <Link href="/case-studies">
                <Button size="lg" variant="inverted" className="h-14 px-10 text-lg gap-2">
                  View Case Studies <ArrowRight className="w-5 h-5" />
                </Button>
              </Link>
            </div>
          </motion.div>
        </div>
      </section>
    </div>
  );
}
