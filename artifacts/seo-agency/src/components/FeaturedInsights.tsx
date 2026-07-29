import { useState, useEffect, useCallback } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Link } from "wouter";
import { ArrowRight, Clock, ChevronLeft, ChevronRight, BookOpen } from "lucide-react";
import { Button } from "@/components/ui/button";
import type { BlogPost } from "@workspace/api-client-react";

const CARD_GRADIENTS = [
  "linear-gradient(135deg, #101A6A 0%, #16284a 50%, #0d1535 100%)",
  "linear-gradient(135deg, #0d1a4a 0%, #101A6A 50%, #1a1060 100%)",
  "linear-gradient(135deg, #0f1d5c 0%, #142060 50%, #101A6A 100%)",
];

interface FeaturedInsightsProps {
  posts: BlogPost[];
}

export function FeaturedInsights({ posts }: FeaturedInsightsProps) {
  const [active, setActive] = useState(0);
  const [direction, setDirection] = useState(1);

  const go = useCallback((idx: number) => {
    setDirection(idx > active ? 1 : -1);
    setActive(idx);
  }, [active]);

  const next = useCallback(() => go((active + 1) % posts.length), [active, posts.length, go]);
  const prev = useCallback(() => go((active - 1 + posts.length) % posts.length), [active, posts.length, go]);

  useEffect(() => {
    const t = setTimeout(next, 5000);
    return () => clearTimeout(t);
  }, [active, next]);

  if (!posts.length) return null;

  const post = posts[active];

  return (
    <section className="py-28 bg-background bg-dot-pattern relative overflow-hidden">
      {/* Subtle brand glow — top right */}
      <div className="absolute top-0 right-0 w-[600px] h-[400px] pointer-events-none"
        style={{ background: "radial-gradient(ellipse at top right, rgba(22,177,212,0.06) 0%, transparent 60%)" }} />

      <div className="container mx-auto px-4 relative z-10">

        {/* ── Section header ── */}
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
          <motion.div
            initial={{ opacity: 0, y: 16 }} whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
          >
            <div className="section-label mb-4">
              <span className="relative flex h-2 w-2">
                <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75" />
                <span className="relative inline-flex rounded-full h-2 w-2 bg-primary" />
              </span>
              Latest Insights
            </div>
            <h2 className="text-4xl md:text-5xl font-extrabold tracking-tight text-foreground">
              Knowledge That{" "}
              <span className="gradient-text-primary">Drives Results</span>
            </h2>
          </motion.div>

          <Link href="/blog" className="hidden md:block">
            <Button variant="outline" className="gap-2">
              View All Articles <ArrowRight className="w-4 h-4" />
            </Button>
          </Link>
        </div>

        {/* ── Main grid ── */}
        <div className="grid lg:grid-cols-5 gap-6 items-stretch">

          {/* Featured card — left 3 cols, keeps navy gradient as accent */}
          <div className="lg:col-span-3 relative rounded-3xl overflow-hidden min-h-[460px] cursor-pointer group shadow-2xl"
            style={{ boxShadow: "0 20px 60px rgba(16,26,106,0.18), 0 0 0 1px rgba(16,26,106,0.08)" }}>

            <AnimatePresence mode="wait" custom={direction}>
              <motion.div
                key={active}
                custom={direction}
                initial={{ opacity: 0, x: direction * 50 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: direction * -50 }}
                transition={{ duration: 0.45, ease: [0.32, 0.72, 0, 1] }}
                className="absolute inset-0"
              >
                {/* Navy gradient background */}
                <div className="absolute inset-0" style={{ background: CARD_GRADIENTS[active % CARD_GRADIENTS.length] }} />

                {/* Cyan glow accent */}
                <div className="absolute top-0 right-0 w-72 h-72 opacity-10 pointer-events-none"
                  style={{ background: "radial-gradient(circle at top right, #16B1D4, transparent 70%)" }} />

                {/* Decorative rings */}
                <svg className="absolute bottom-0 right-0 w-52 h-52 opacity-[0.06]" viewBox="0 0 200 200" fill="none">
                  <circle cx="150" cy="150" r="110" stroke="#16B1D4" strokeWidth="1" />
                  <circle cx="150" cy="150" r="75" stroke="#16B1D4" strokeWidth="1" />
                  <circle cx="150" cy="150" r="40" stroke="#16B1D4" strokeWidth="1" />
                </svg>

                {/* Content pinned to bottom */}
                <div className="absolute inset-0 flex flex-col justify-end p-8 md:p-10">
                  {/* Category + read time */}
                  <div className="flex items-center gap-3 mb-4">
                    <span className="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white"
                      style={{ background: "#16B1D4" }}>
                      {post.category}
                    </span>
                    <span className="flex items-center gap-1.5 text-white/50 text-xs">
                      <Clock className="w-3 h-3" /> 5 min read
                    </span>
                  </div>

                  <h3 className="text-2xl md:text-3xl font-extrabold text-white leading-tight mb-3
                    group-hover:text-[#16B1D4] transition-colors duration-300">
                    {post.title}
                  </h3>

                  <p className="text-white/55 text-sm line-clamp-2 mb-7 leading-relaxed">
                    {post.excerpt}
                  </p>

                  <div className="flex items-center justify-between">
                    {/* Author */}
                    <div className="flex items-center gap-3">
                      <div className="w-9 h-9 rounded-full flex items-center justify-center font-black text-sm"
                        style={{ background: "rgba(22,177,212,0.25)", color: "#16B1D4", border: "1px solid rgba(22,177,212,0.4)" }}>
                        {post.author.charAt(0)}
                      </div>
                      <div>
                        <p className="text-white text-sm font-semibold leading-none">{post.author}</p>
                        <p className="text-white/40 text-xs mt-0.5">{post.authorRole}</p>
                      </div>
                    </div>

                    <Link href={`/blog/${post.slug}`}>
                      <button
                        className="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300"
                        style={{ background: "#16B1D4", color: "#fff", boxShadow: "0 4px 16px rgba(22,177,212,0.4)" }}
                        onMouseEnter={e => { (e.currentTarget as HTMLElement).style.opacity = "0.88"; }}
                        onMouseLeave={e => { (e.currentTarget as HTMLElement).style.opacity = "1"; }}
                      >
                        Read Article <ArrowRight className="w-4 h-4" />
                      </button>
                    </Link>
                  </div>
                </div>
              </motion.div>
            </AnimatePresence>

            {/* Prev / Next arrows */}
            <button onClick={prev}
              className="absolute left-4 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full flex items-center justify-center transition-all duration-200 opacity-0 group-hover:opacity-100"
              style={{ background: "rgba(255,255,255,0.12)", border: "1px solid rgba(255,255,255,0.18)" }}>
              <ChevronLeft className="w-4 h-4 text-white" />
            </button>
            <button onClick={next}
              className="absolute right-4 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full flex items-center justify-center transition-all duration-200 opacity-0 group-hover:opacity-100"
              style={{ background: "rgba(255,255,255,0.12)", border: "1px solid rgba(255,255,255,0.18)" }}>
              <ChevronRight className="w-4 h-4 text-white" />
            </button>
          </div>

          {/* Sidebar — right 2 cols */}
          <div className="lg:col-span-2 flex flex-col gap-3">
            {posts.map((p, i) => (
              <motion.div
                key={p.id}
                initial={{ opacity: 0, x: 20 }} whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }} transition={{ delay: i * 0.1 }}
                onClick={() => go(i)}
                className="relative rounded-2xl p-5 cursor-pointer transition-all duration-300 group/card flex-1 bg-card"
                style={{
                  border: active === i
                    ? "1.5px solid rgba(22,177,212,0.5)"
                    : "1.5px solid hsl(var(--border))",
                  boxShadow: active === i
                    ? "0 4px 24px rgba(22,177,212,0.1), inset 0 0 0 1px rgba(22,177,212,0.08)"
                    : "0 1px 4px rgba(0,0,0,0.04)",
                  background: active === i
                    ? "linear-gradient(135deg, rgba(22,177,212,0.05) 0%, hsl(var(--card)) 100%)"
                    : "hsl(var(--card))",
                }}
              >
                {/* Active progress bar */}
                {active === i && (
                  <motion.div
                    className="absolute bottom-0 left-0 h-0.5 rounded-b-2xl"
                    style={{ background: "linear-gradient(to right, #16B1D4, #7dd8ef)" }}
                    initial={{ width: "0%" }}
                    animate={{ width: "100%" }}
                    transition={{ duration: 5, ease: "linear" }}
                  />
                )}

                <div className="flex items-start gap-4">
                  {/* Number badge */}
                  <div className="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300 font-black text-sm"
                    style={{
                      background: active === i ? "#16B1D4" : "rgba(22,177,212,0.08)",
                      color: active === i ? "#fff" : "#16B1D4",
                      border: active === i ? "none" : "1.5px solid rgba(22,177,212,0.2)",
                    }}>
                    0{i + 1}
                  </div>

                  <div className="flex-1 min-w-0">
                    <span className="text-xs font-bold uppercase tracking-wider block mb-1.5"
                      style={{ color: "#16B1D4" }}>
                      {p.category}
                    </span>
                    <p className="text-sm font-semibold leading-snug line-clamp-2 transition-colors duration-200"
                      style={{ color: active === i ? "hsl(var(--foreground))" : "hsl(var(--foreground) / 0.75)" }}>
                      {p.title}
                    </p>
                    <AnimatePresence>
                      {active === i && (
                        <motion.p
                          initial={{ opacity: 0, height: 0 }}
                          animate={{ opacity: 1, height: "auto" }}
                          exit={{ opacity: 0, height: 0 }}
                          className="text-xs text-muted-foreground line-clamp-2 mt-1.5 leading-relaxed"
                        >
                          {p.excerpt}
                        </motion.p>
                      )}
                    </AnimatePresence>
                  </div>

                  <ArrowRight className="w-4 h-4 shrink-0 opacity-0 group-hover/card:opacity-100 transition-opacity mt-0.5"
                    style={{ color: "#16B1D4" }} />
                </div>
              </motion.div>
            ))}

            {/* Explore All CTA */}
            <Link href="/blog">
              <div className="rounded-2xl p-5 cursor-pointer group/cta flex items-center justify-between transition-all duration-300"
                style={{
                  background: "linear-gradient(135deg, #101A6A 0%, #16284a 100%)",
                  boxShadow: "0 4px 20px rgba(16,26,106,0.2)",
                }}>
                <div className="flex items-center gap-3">
                  <div className="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                    style={{ background: "rgba(22,177,212,0.2)" }}>
                    <BookOpen className="w-4 h-4" style={{ color: "#16B1D4" }} />
                  </div>
                  <div>
                    <p className="text-white font-bold text-sm leading-none">Explore All Articles</p>
                    <p className="text-white/45 text-xs mt-1">15+ expert guides &amp; case studies</p>
                  </div>
                </div>
                <div className="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-transform duration-300 group-hover/cta:translate-x-1"
                  style={{ background: "#16B1D4" }}>
                  <ArrowRight className="w-4 h-4 text-white" />
                </div>
              </div>
            </Link>
          </div>
        </div>

        {/* Dot navigation */}
        <div className="flex justify-center gap-2 mt-10">
          {posts.map((_, i) => (
            <button
              key={i}
              onClick={() => go(i)}
              className="transition-all duration-300 rounded-full"
              style={{
                width: active === i ? "2rem" : "0.5rem",
                height: "0.5rem",
                background: active === i ? "#16B1D4" : "hsl(var(--border))",
              }}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
