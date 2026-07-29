import { useGetAgencyStats, useGetFeaturedContent } from "@workspace/api-client-react";
import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Skeleton } from "@/components/ui/skeleton";
import { TestimonialSlider } from "@/components/TestimonialSlider";
import { MarqueeTicker } from "@/components/MarqueeTicker";
import { FeaturedInsights } from "@/components/FeaturedInsights";
import { motion } from "framer-motion";
import {
  ArrowRight, BarChart, ChevronRight, Code, PenTool,
  Search, Smartphone, TrendingUp, TrendingDown,
  CheckCircle2, Star, Users, Award
} from "lucide-react";
import { Card } from "@/components/ui/card";

/* ─────────────── Hero Dashboard Widget ─────────────── */
function SeoDashboard() {
  const keywords = [
    { kw: "SEO agency Dubai",       pos: 1,  trend: "up",   change: "+3" },
    { kw: "Google Ads UAE",         pos: 2,  trend: "up",   change: "+5" },
    { kw: "digital marketing Dubai",pos: 4,  trend: "up",   change: "+2" },
    { kw: "web design Abu Dhabi",   pos: 6,  trend: "down", change: "-1" },
  ];

  // SVG sparkline points (traffic growth Jan→Aug)
  const traffic = [42, 55, 48, 70, 83, 97, 108, 134];
  const maxT = Math.max(...traffic);
  const pts = traffic.map((v, i) =>
    `${(i / (traffic.length - 1)) * 220},${58 - (v / maxT) * 52}`
  ).join(" ");

  return (
    <motion.div
      initial={{ opacity: 0, x: 40, y: 20 }}
      animate={{ opacity: 1, x: 0, y: 0 }}
      transition={{ duration: 0.8, delay: 0.4, ease: [0.32, 0.72, 0, 1] }}
      className="relative w-full max-w-md mx-auto lg:ml-auto animate-float"
    >
      {/* Glow behind card */}
      <div className="absolute -inset-4 rounded-3xl opacity-30 blur-2xl"
        style={{ background: "radial-gradient(circle, #16B1D4 0%, transparent 70%)" }} />

      {/* Main card */}
      <div className="relative rounded-2xl overflow-hidden"
        style={{
          background: "rgba(10,16,60,0.95)",
          border: "1px solid rgba(22,177,212,0.25)",
          boxShadow: "0 30px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(22,177,212,0.1)",
          backdropFilter: "blur(20px)",
        }}>

        {/* Header */}
        <div className="flex items-center justify-between px-5 py-4 border-b"
          style={{ borderColor: "rgba(22,177,212,0.15)" }}>
          <div className="flex items-center gap-2.5">
            <div className="w-7 h-7 rounded-lg flex items-center justify-center"
              style={{ background: "rgba(22,177,212,0.2)" }}>
              <TrendingUp className="w-4 h-4" style={{ color: "#16B1D4" }} />
            </div>
            <span className="text-white font-bold text-sm">Live SEO Dashboard</span>
          </div>
          <div className="flex items-center gap-1.5">
            <span className="relative flex h-2 w-2">
              <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75" />
              <span className="relative inline-flex rounded-full h-2 w-2 bg-green-400" />
            </span>
            <span className="text-green-400 text-xs font-semibold">Live</span>
          </div>
        </div>

        {/* Traffic chart */}
        <div className="px-5 pt-4 pb-2">
          <div className="flex items-end justify-between mb-1">
            <span className="text-white/40 text-xs font-medium">Organic Traffic</span>
            <span className="text-green-400 text-xs font-bold flex items-center gap-1">
              <TrendingUp className="w-3 h-3" /> +127% this quarter
            </span>
          </div>
          <svg viewBox="0 0 220 64" className="w-full" style={{ height: 64 }} preserveAspectRatio="none">
            {/* Area fill */}
            <defs>
              <linearGradient id="chartGrad" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stopColor="#16B1D4" stopOpacity="0.4" />
                <stop offset="100%" stopColor="#16B1D4" stopOpacity="0" />
              </linearGradient>
            </defs>
            <polygon
              points={`0,64 ${pts} 220,64`}
              fill="url(#chartGrad)"
            />
            <polyline
              points={pts}
              fill="none"
              stroke="#16B1D4"
              strokeWidth="2"
              strokeLinecap="round"
              strokeLinejoin="round"
            />
            {/* Last dot */}
            <circle cx="220" cy={58 - (traffic[7] / maxT) * 52} r="3.5" fill="#16B1D4" />
          </svg>
          <div className="flex justify-between text-white/25 text-[10px] mt-0.5">
            {["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug"].map(m => (
              <span key={m}>{m}</span>
            ))}
          </div>
        </div>

        {/* Divider */}
        <div className="mx-5 my-2 h-px" style={{ background: "rgba(22,177,212,0.12)" }} />

        {/* Keyword Rankings */}
        <div className="px-5 pb-2">
          <div className="text-white/40 text-xs font-medium mb-2">Keyword Rankings</div>
          <div className="space-y-1.5">
            {keywords.map((kw, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, x: 12 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ delay: 0.6 + i * 0.1 }}
                className="flex items-center justify-between rounded-lg px-3 py-2"
                style={{ background: "rgba(255,255,255,0.04)" }}
              >
                <div className="flex items-center gap-2 min-w-0">
                  <span className="w-5 h-5 rounded flex items-center justify-center text-[10px] font-black shrink-0"
                    style={{ background: kw.pos <= 3 ? "#16B1D4" : "rgba(22,177,212,0.2)", color: kw.pos <= 3 ? "#fff" : "#16B1D4" }}>
                    {kw.pos}
                  </span>
                  <span className="text-white/70 text-xs truncate">{kw.kw}</span>
                </div>
                <span className={`text-xs font-bold flex items-center gap-0.5 shrink-0 ${kw.trend === "up" ? "text-green-400" : "text-red-400"}`}>
                  {kw.trend === "up" ? <TrendingUp className="w-3 h-3" /> : <TrendingDown className="w-3 h-3" />}
                  {kw.change}
                </span>
              </motion.div>
            ))}
          </div>
        </div>

        {/* Footer stats */}
        <div className="grid grid-cols-3 gap-0 border-t mt-3"
          style={{ borderColor: "rgba(22,177,212,0.15)" }}>
          {[
            { label: "Domain Authority", value: "72" },
            { label: "Backlinks", value: "8.4K" },
            { label: "Indexed Pages", value: "2,140" },
          ].map((stat, i) => (
            <div key={i} className={`px-4 py-3 text-center ${i < 2 ? "border-r" : ""}`}
              style={{ borderColor: "rgba(22,177,212,0.15)" }}>
              <div className="text-white font-black text-sm">{stat.value}</div>
              <div className="text-white/35 text-[10px] mt-0.5 leading-tight">{stat.label}</div>
            </div>
          ))}
        </div>
      </div>

      {/* Floating badges */}
      <motion.div
        initial={{ opacity: 0, scale: 0.8 }}
        animate={{ opacity: 1, scale: 1 }}
        transition={{ delay: 1.1 }}
        className="absolute -top-4 -right-4 rounded-xl px-3 py-2 shadow-xl"
        style={{ background: "#16B1D4", boxShadow: "0 8px 24px rgba(22,177,212,0.4)" }}
      >
        <div className="text-white text-xs font-black">+340% ROI</div>
        <div className="text-white/80 text-[10px]">Average Client</div>
      </motion.div>

      <motion.div
        initial={{ opacity: 0, scale: 0.8 }}
        animate={{ opacity: 1, scale: 1 }}
        transition={{ delay: 1.3 }}
        className="absolute -bottom-4 -left-4 rounded-xl px-3 py-2 shadow-xl flex items-center gap-2"
        style={{ background: "rgba(10,16,60,0.95)", border: "1px solid rgba(22,177,212,0.3)", boxShadow: "0 8px 24px rgba(0,0,0,0.4)" }}
      >
        <div className="flex">
          {[0,1,2,3,4].map(i => <Star key={i} className="w-3 h-3 fill-yellow-400 text-yellow-400" />)}
        </div>
        <span className="text-white text-xs font-bold">4.9/5 Google</span>
      </motion.div>
    </motion.div>
  );
}

/* ─────────────── Main Page ─────────────── */
export default function Home() {
  const { data: stats, isLoading: statsLoading } = useGetAgencyStats();
  const { data: featured, isLoading: featuredLoading } = useGetFeaturedContent();

  return (
    <div className="flex flex-col min-h-screen">

      {/* ── HERO: split layout ── */}
      <section className="hero-dark bg-grid-pattern-dark relative pt-32 pb-20 overflow-hidden">
        {/* Background image overlay */}
        <div className="absolute inset-0 z-0">
          <img
            src="/images/dubai-hero.jpg"
            alt="Dubai skyline"
            className="w-full h-full object-cover opacity-15 object-center"
            onError={(e) => { (e.currentTarget as HTMLImageElement).style.display = "none"; }}
          />
          <div className="absolute inset-0"
            style={{ background: "linear-gradient(135deg, rgba(16,26,106,0.98) 0%, rgba(10,16,60,0.95) 60%, rgba(16,26,106,0.90) 100%)" }} />
        </div>

        <div className="container relative z-10 mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {/* LEFT: headline + CTAs + stats */}
            <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.7 }}>
              <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-7"
                style={{ background: "rgba(22,177,212,0.15)", border: "1px solid rgba(22,177,212,0.3)" }}>
                <span className="relative flex h-2 w-2">
                  <span className="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style={{ background: "#16B1D4" }} />
                  <span className="relative inline-flex rounded-full h-2 w-2" style={{ background: "#16B1D4" }} />
                </span>
                <span className="text-xs font-black uppercase tracking-widest" style={{ color: "#16B1D4" }}>Dubai's #1 Enterprise SEO Agency</span>
              </div>

              <h1 className="text-5xl md:text-6xl xl:text-7xl font-extrabold tracking-tight text-white leading-[1.08] mb-7">
                Turn Search<br />
                <span style={{
                  background: "linear-gradient(135deg, #16B1D4 0%, #7dd8ef 50%, #ffffff 100%)",
                  WebkitBackgroundClip: "text",
                  WebkitTextFillColor: "transparent",
                  backgroundClip: "text",
                }}>Visibility Into</span><br />
                Business Growth
              </h1>

              <p className="text-lg text-white/65 max-w-lg mb-10 leading-relaxed font-light">
                We architect digital dominance for Dubai's most ambitious brands — combining AI-driven SEO, precision paid media, and conversion-led design to make you the market leader.
              </p>

              <div className="flex flex-col sm:flex-row gap-4 mb-14">
                <Link href="/contact">
                  <Button size="lg" className="w-full sm:w-auto gap-2 text-base h-14 px-9 font-bold"
                    style={{ background: "#16B1D4", color: "#fff", boxShadow: "0 8px 30px rgba(22,177,212,0.4)" }}>
                    Get Free SEO Audit <ArrowRight className="w-5 h-5" />
                  </Button>
                </Link>
                <Link href="/case-studies">
                  <Button variant="inverted" size="lg" className="w-full sm:w-auto h-14 px-9 text-base font-bold">
                    View Case Studies
                  </Button>
                </Link>
              </div>

              {/* Stats row */}
              <div className="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-8 border-t border-white/10">
                {statsLoading ? (
                  [1,2,3,4].map(i => <Skeleton key={i} className="h-16 bg-white/10 rounded-xl" />)
                ) : stats ? (
                  <>
                    {[
                      { value: `+${stats.averageRoiIncrease}%`, label: "Avg. ROI Increase" },
                      { value: `${stats.projectsCompleted}+`,   label: "Projects Delivered" },
                      { value: `${stats.googleRating}/5`,       label: "Google Rating" },
                      { value: `${stats.yearsExperience}+`,     label: "Years Experience" },
                    ].map((s, i) => (
                      <motion.div key={i}
                        initial={{ opacity: 0, y: 10 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.8 + i * 0.1 }}>
                        <div className="text-3xl md:text-4xl font-black text-white mb-1 font-mono tracking-tight"
                          style={{ textShadow: "0 0 20px rgba(22,177,212,0.4)" }}>{s.value}</div>
                        <div className="text-xs font-bold uppercase tracking-wider" style={{ color: "#16B1D4" }}>{s.label}</div>
                      </motion.div>
                    ))}
                  </>
                ) : null}
              </div>
            </motion.div>

            {/* RIGHT: dashboard widget */}
            <div className="hidden lg:block">
              <SeoDashboard />
            </div>

          </div>
        </div>
      </section>

      {/* ── MARQUEE TICKER ── */}
      <MarqueeTicker />

      {/* ── SERVICES GRID ── */}
      <section className="py-28 bg-background bg-grid-pattern relative">
        <div className="container mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }}
            className="text-center max-w-3xl mx-auto mb-20"
          >
            <div className="section-label">Our Expertise</div>
            <h2 className="text-4xl md:text-5xl font-extrabold text-foreground mb-5 mt-4">Full-Spectrum Digital Growth</h2>
            <p className="text-muted-foreground text-lg">We orchestrate multi-channel strategies that compound over time, turning your digital presence into your most valuable business asset.</p>
          </motion.div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {[
              { title: "Enterprise SEO",          icon: TrendingUp, desc: "Data-driven organic growth strategies that capture high-intent search real estate and drive compounding revenue.",        link: "/services/seo",                    color: "#16B1D4" },
              { title: "AI Search Optimization",  icon: Search,     desc: "Prepare for the future. Optimization for LLMs, ChatGPT, and AI Overviews to keep you visible everywhere.",              link: "/services/ai-search-optimization",  color: "#101A6A" },
              { title: "PPC & Google Ads",         icon: BarChart,   desc: "Hyper-targeted paid media strategies engineered for maximum ROAS and immediate high-quality lead generation.",          link: "/services/ppc",                    color: "#16B1D4" },
              { title: "Social Media Marketing",  icon: Smartphone, desc: "Scroll-stopping content and community management that builds brand authority and loyal audiences at scale.",              link: "/services/social-media-marketing", color: "#101A6A" },
              { title: "Premium Web Design",      icon: PenTool,    desc: "High-end, conversion-optimized interfaces that command trust and elevate your brand perception instantly.",               link: "/services/web-design",              color: "#16B1D4" },
              { title: "Web Development",         icon: Code,       desc: "Lightning-fast, scalable applications built on React, Next.js, and headless CMS — built for growth.",                    link: "/services/web-development",        color: "#101A6A" },
            ].map((service, i) => (
              <motion.div key={i}
                initial={{ opacity: 0, y: 24 }} whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }} transition={{ delay: i * 0.08 }}
              >
                <Link href={service.link}>
                  <div className="card-lift h-full group p-8 relative overflow-hidden cursor-pointer">
                    {/* Top accent line */}
                    <div className="absolute top-0 left-0 w-full h-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                      style={{ background: `linear-gradient(to right, ${service.color}, transparent)` }} />
                    {/* Subtle bg glow on hover */}
                    <div className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"
                      style={{ background: `radial-gradient(ellipse at top left, ${service.color}08, transparent 60%)` }} />
                    <div className="relative z-10">
                      <div className="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300"
                        style={{ background: `${service.color}18`, border: `1px solid ${service.color}30` }}>
                        <service.icon className="w-7 h-7" style={{ color: service.color }} />
                      </div>
                      <h3 className="text-xl font-extrabold text-foreground mb-3 group-hover:text-primary transition-colors">{service.title}</h3>
                      <p className="text-muted-foreground text-sm leading-relaxed mb-6">{service.desc}</p>
                      <div className="flex items-center text-primary font-bold text-sm gap-2">
                        Explore Service <ChevronRight className="w-4 h-4 group-hover:translate-x-2 transition-transform" />
                      </div>
                    </div>
                  </div>
                </Link>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* ── WHY CHOOSE US ── */}
      <section className="py-24 overflow-hidden bg-muted/30 border-y border-border">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-16 items-center">

            {/* Left: image + floating badge */}
            <motion.div initial={{ opacity: 0, x: -30 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }}
              className="relative order-2 lg:order-1">
              <div className="absolute -inset-4 rounded-3xl opacity-20"
                style={{ background: "linear-gradient(135deg, #16B1D4, #101A6A)", filter: "blur(20px)" }} />
              <img
                src="/images/ai-brain.jpg"
                alt="AI-Driven SEO Strategy"
                className="rounded-3xl relative z-10 shadow-2xl object-cover w-full"
                style={{ height: 480 }}
                onError={(e) => {
                  const el = e.currentTarget as HTMLImageElement;
                  el.style.display = "none";
                  const parent = el.parentElement!;
                  const placeholder = document.createElement("div");
                  placeholder.className = "rounded-3xl relative z-10 w-full flex items-center justify-center text-white font-bold text-xl";
                  placeholder.style.cssText = "height:480px;background:linear-gradient(135deg,#101A6A,#16B1D4)";
                  placeholder.textContent = "AI-Driven SEO";
                  parent.appendChild(placeholder);
                }}
              />
              {/* Floating result badge */}
              <motion.div
                initial={{ opacity: 0, scale: 0.8 }} whileInView={{ opacity: 1, scale: 1 }}
                viewport={{ once: true }} transition={{ delay: 0.3 }}
                className="absolute -bottom-5 -right-5 z-20 rounded-2xl p-4 shadow-2xl"
                style={{ background: "#fff", border: "2px solid #16B1D4" }}>
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 rounded-xl flex items-center justify-center" style={{ background: "#16B1D4" }}>
                    <Award className="w-5 h-5 text-white" />
                  </div>
                  <div>
                    <div className="text-lg font-black text-secondary leading-tight">1,200+</div>
                    <div className="text-xs font-bold text-muted-foreground uppercase tracking-wider">Campaigns Run</div>
                  </div>
                </div>
              </motion.div>
              <motion.div
                initial={{ opacity: 0, scale: 0.8 }} whileInView={{ opacity: 1, scale: 1 }}
                viewport={{ once: true }} transition={{ delay: 0.5 }}
                className="absolute -top-5 -left-5 z-20 rounded-2xl p-4 shadow-2xl"
                style={{ background: "#101A6A" }}>
                <div className="flex items-center gap-3">
                  <Users className="w-5 h-5 text-white" />
                  <div>
                    <div className="text-lg font-black text-white leading-tight">200+ Clients</div>
                    <div className="text-xs font-bold text-white/60 uppercase tracking-wider">UAE & GCC</div>
                  </div>
                </div>
              </motion.div>
            </motion.div>

            {/* Right: text */}
            <motion.div initial={{ opacity: 0, x: 30 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }}
              className="order-1 lg:order-2">
              <div className="section-label">Why SEO.ae</div>
              <h2 className="text-4xl md:text-5xl font-extrabold mt-4 mb-6 leading-tight"
                style={{ color: "#101A6A" }}>
                We Turn Clicks<br />Into Revenue
              </h2>
              <p className="text-lg text-muted-foreground mb-10 leading-relaxed">
                Stop paying for vanity metrics. Every strategy we build is tied to qualified leads, pipeline growth, and bottom-line revenue — with full transparency every step of the way.
              </p>
              <ul className="space-y-5 mb-10">
                {[
                  { title: "Data-backed decisions, not guesswork",          desc: "Every move is backed by real analytics, competitor intelligence, and search data." },
                  { title: "Elite technical execution",                      desc: "From Core Web Vitals to structured data, we engineer sites that Google loves." },
                  { title: "Transparent reporting aligned to business KPIs", desc: "Monthly reports that show revenue impact, not just rankings." },
                  { title: "Agile strategies that adapt to market shifts",   desc: "We pivot fast when Google updates hit — keeping you ahead of competitors." },
                ].map((item, i) => (
                  <motion.li key={i}
                    initial={{ opacity: 0, x: 15 }} whileInView={{ opacity: 1, x: 0 }}
                    viewport={{ once: true }} transition={{ delay: i * 0.1 }}
                    className="flex items-start gap-4">
                    <CheckCircle2 className="w-6 h-6 shrink-0 mt-0.5" style={{ color: "#16B1D4" }} />
                    <div>
                      <div className="font-bold text-foreground">{item.title}</div>
                      <div className="text-sm text-muted-foreground mt-0.5">{item.desc}</div>
                    </div>
                  </motion.li>
                ))}
              </ul>
              <Link href="/about">
                <Button size="lg" className="h-13 px-8 gap-2 font-bold"
                  style={{ background: "#101A6A", color: "#fff" }}>
                  About Our Agency <ArrowRight className="w-5 h-5" />
                </Button>
              </Link>
            </motion.div>

          </div>
        </div>
      </section>

      {/* ── CASE STUDIES ── */}
      <section className="py-28 bg-background relative overflow-hidden">
        <div className="absolute inset-0 bg-dot-pattern opacity-30" />
        <div className="container mx-auto px-4 relative z-10">
          <div className="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <motion.div initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }}>
              <div className="section-label">Proven Results</div>
              <h2 className="text-4xl md:text-5xl font-extrabold text-foreground mt-4">We Build Market Leaders</h2>
            </motion.div>
            <Link href="/case-studies">
              <Button variant="outline" className="hidden md:flex gap-2">
                All Case Studies <ArrowRight className="w-4 h-4" />
              </Button>
            </Link>
          </div>

          {featuredLoading ? (
            <div className="grid md:grid-cols-2 gap-8">
              <Skeleton className="h-[420px] rounded-2xl" />
              <Skeleton className="h-[420px] rounded-2xl" />
            </div>
          ) : featured?.caseStudies ? (
            <div className="grid md:grid-cols-2 gap-8">
              {featured.caseStudies.slice(0, 2).map((cs, idx) => (
                <motion.div key={cs.id}
                  initial={{ opacity: 0, y: 24 }} whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }} transition={{ delay: idx * 0.15 }}>
                  <Link href={`/case-studies`}>
                    <Card className="group overflow-hidden border-border hover:border-primary/50 hover:shadow-xl transition-all h-full flex flex-col cursor-pointer">
                      <div className="relative overflow-hidden" style={{ height: 220 }}>
                        <div className="w-full h-full"
                          style={{ background: idx === 0
                            ? "linear-gradient(135deg, #101A6A 0%, #16B1D4 100%)"
                            : "linear-gradient(135deg, #0d1535 0%, #101A6A 50%, #16284a 100%)" }}>
                          {/* Decorative */}
                          <div className="absolute inset-0 flex items-center justify-center opacity-10">
                            <svg viewBox="0 0 200 120" className="w-3/4" fill="none">
                              <polyline points="0,100 30,70 60,80 90,40 120,50 150,20 200,30"
                                stroke="white" strokeWidth="2" strokeLinecap="round" />
                              <circle cx="150" cy="20" r="4" fill="white" />
                            </svg>
                          </div>
                          <div className="absolute inset-0 flex items-center justify-center">
                            <div className="text-center">
                              <div className="text-5xl font-black text-white opacity-90 mb-1">
                                {cs.results[0]?.value}
                              </div>
                              <div className="text-white/60 text-sm font-medium">{cs.results[0]?.label}</div>
                            </div>
                          </div>
                        </div>
                        <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent" />
                        <div className="absolute bottom-5 left-5">
                          <div className="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2 inline-block"
                            style={{ background: "#16B1D4", color: "#fff" }}>
                            {cs.service}
                          </div>
                          <h3 className="text-xl font-extrabold text-white">{cs.clientName}</h3>
                        </div>
                      </div>
                      <div className="p-7 flex-1 flex flex-col justify-between">
                        <p className="text-muted-foreground mb-6 font-medium text-sm leading-relaxed">{cs.challenge}</p>
                        <div className="grid grid-cols-2 gap-4">
                          {cs.results.slice(0, 2).map((r, i) => (
                            <div key={i} className="rounded-xl p-4"
                              style={{ background: "linear-gradient(135deg, rgba(22,177,212,0.08), rgba(16,26,106,0.06))", border: "1px solid rgba(22,177,212,0.2)" }}>
                              <div className="text-2xl font-black text-secondary">{r.value}</div>
                              <div className="text-xs font-bold text-muted-foreground uppercase tracking-wider mt-1">{r.label}</div>
                            </div>
                          ))}
                        </div>
                      </div>
                    </Card>
                  </Link>
                </motion.div>
              ))}
            </div>
          ) : null}

          <div className="mt-8 text-center md:hidden">
            <Link href="/case-studies">
              <Button variant="outline" className="w-full h-12">View All Case Studies</Button>
            </Link>
          </div>
        </div>
      </section>

      {/* ── FEATURED INSIGHTS (slider) ── */}
      {!featuredLoading && featured?.blogPosts && featured.blogPosts.length > 0 && (
        <FeaturedInsights posts={featured.blogPosts} />
      )}

      {/* ── TESTIMONIALS ── */}
      <section className="py-28 bg-background border-y border-border">
        <div className="container mx-auto px-4">
          <motion.div initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }}
            className="text-center mb-16">
            <div className="section-label">Client Voices</div>
            <h2 className="text-4xl md:text-5xl font-extrabold text-foreground mt-4">Don't Just Take Our Word For It</h2>
          </motion.div>
          {featuredLoading ? (
            <Skeleton className="w-full max-w-4xl mx-auto h-64 rounded-2xl" />
          ) : featured?.testimonials ? (
            <TestimonialSlider testimonials={featured.testimonials} />
          ) : null}
        </div>
      </section>

      {/* ── FINAL CTA ── */}
      <section className="py-32 hero-dark bg-grid-pattern-dark relative overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img src="/images/seo-visualization.jpg" alt="" aria-hidden
            className="w-full h-full object-cover opacity-10 object-center"
            onError={(e) => { (e.currentTarget as HTMLImageElement).style.display = "none"; }}
          />
        </div>
        <div className="absolute top-0 right-0 w-[500px] h-[500px] rounded-full opacity-10 blur-3xl"
          style={{ background: "radial-gradient(circle, #16B1D4, transparent 70%)" }} />

        <div className="container mx-auto px-4 relative z-10 text-center">
          <motion.div initial={{ opacity: 0, y: 30 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }}>
            <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-7"
              style={{ background: "rgba(22,177,212,0.15)", border: "1px solid rgba(22,177,212,0.3)" }}>
              <span className="text-xs font-black uppercase tracking-widest" style={{ color: "#16B1D4" }}>Free. No Obligation. No Spam.</span>
            </div>
            <h2 className="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
              Ready to Dominate<br />Your Market?
            </h2>
            <p className="text-xl text-white/70 max-w-2xl mx-auto mb-12 font-light leading-relaxed">
              Stop losing customers to competitors with inferior products but better visibility. Get your free SEO audit today and discover your growth potential.
            </p>
            <div className="flex flex-col sm:flex-row justify-center gap-4">
              <Link href="/contact">
                <Button size="lg" className="h-14 px-10 text-lg w-full sm:w-auto font-bold gap-2"
                  style={{ background: "#16B1D4", color: "#fff", boxShadow: "0 8px 30px rgba(22,177,212,0.4)" }}>
                  Get Your Free Growth Audit <ArrowRight className="w-5 h-5" />
                </Button>
              </Link>
              <Link href="/services">
                <Button size="lg" variant="inverted" className="h-14 px-10 text-lg w-full sm:w-auto font-bold">
                  Explore Services
                </Button>
              </Link>
            </div>
          </motion.div>
        </div>
      </section>

    </div>
  );
}
