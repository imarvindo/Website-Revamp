import { useState, useEffect, useCallback } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Link } from "wouter";
import { ArrowRight, Clock, Tag, ChevronLeft, ChevronRight } from "lucide-react";
import { Button } from "@/components/ui/button";
import type { BlogPost } from "@workspace/api-client-react";

const CARD_GRADIENTS = [
  "from-[#101A6A] via-[#16284a] to-[#0d1535]",
  "from-[#0d1a4a] via-[#101A6A] to-[#1a1060]",
  "from-[#0f1d5c] via-[#142060] to-[#101A6A]",
];

const ACCENT_PATTERNS = [
  "bg-gradient-to-br from-[#16B1D4]/20 to-transparent",
  "bg-gradient-to-tr from-[#16B1D4]/15 to-transparent",
  "bg-gradient-to-bl from-[#16B1D4]/18 to-transparent",
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

  // Auto-rotate every 5 seconds
  useEffect(() => {
    const t = setTimeout(next, 5000);
    return () => clearTimeout(t);
  }, [active, next]);

  if (!posts.length) return null;

  const post = posts[active];

  return (
    <section
      className="relative py-28 overflow-hidden"
      style={{
        background: "linear-gradient(135deg, #0a1240 0%, #101A6A 50%, #0d1535 100%)",
      }}
    >
      {/* Grid overlay */}
      <div className="absolute inset-0 bg-grid-pattern-dark opacity-40" />

      {/* Glow blobs */}
      <div className="absolute top-0 right-0 w-[600px] h-[600px] rounded-full opacity-10 blur-3xl"
        style={{ background: "radial-gradient(circle, #16B1D4 0%, transparent 70%)" }} />
      <div className="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full opacity-8 blur-3xl"
        style={{ background: "radial-gradient(circle, #16B1D4 0%, transparent 70%)" }} />

      <div className="container mx-auto px-4 relative z-10">
        {/* Section header */}
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
          <div>
            <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-4"
              style={{ background: "rgba(22,177,212,0.15)", color: "#16B1D4", border: "1px solid rgba(22,177,212,0.3)" }}>
              <span className="relative flex h-2 w-2">
                <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#16B1D4] opacity-75" />
                <span className="relative inline-flex rounded-full h-2 w-2 bg-[#16B1D4]" />
              </span>
              Latest Insights
            </div>
            <h2 className="text-4xl md:text-5xl font-extrabold text-white tracking-tight">
              Knowledge That<br />
              <span style={{
                background: "linear-gradient(135deg, #16B1D4, #7dd8ef)",
                WebkitBackgroundClip: "text",
                WebkitTextFillColor: "transparent",
                backgroundClip: "text",
              }}>Drives Results</span>
            </h2>
          </div>
          <Link href="/blog">
            <Button variant="outline" className="border-white/20 text-white hover:bg-white/10 hover:text-white gap-2 hidden md:flex">
              View All Articles <ArrowRight className="w-4 h-4" />
            </Button>
          </Link>
        </div>

        {/* Main carousel + sidebar */}
        <div className="grid lg:grid-cols-5 gap-6">
          {/* Featured large card — 3 cols */}
          <div className="lg:col-span-3 relative rounded-3xl overflow-hidden min-h-[480px] cursor-pointer group"
            style={{ boxShadow: "0 25px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(22,177,212,0.15)" }}>

            <AnimatePresence mode="wait" custom={direction}>
              <motion.div
                key={active}
                custom={direction}
                initial={{ opacity: 0, x: direction * 60 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: direction * -60 }}
                transition={{ duration: 0.5, ease: [0.32, 0.72, 0, 1] }}
                className="absolute inset-0"
              >
                {/* Background */}
                <div className={`absolute inset-0 bg-gradient-to-br ${CARD_GRADIENTS[active % CARD_GRADIENTS.length]}`} />
                <div className={`absolute inset-0 ${ACCENT_PATTERNS[active % ACCENT_PATTERNS.length]}`} />

                {/* Decorative elements */}
                <div className="absolute top-0 right-0 w-64 h-64 opacity-10"
                  style={{ background: "radial-gradient(circle at top right, #16B1D4, transparent 70%)" }} />
                <svg className="absolute bottom-0 right-0 w-48 h-48 opacity-5" viewBox="0 0 200 200" fill="none">
                  <circle cx="150" cy="150" r="100" stroke="#16B1D4" strokeWidth="1" />
                  <circle cx="150" cy="150" r="70" stroke="#16B1D4" strokeWidth="1" />
                  <circle cx="150" cy="150" r="40" stroke="#16B1D4" strokeWidth="1" />
                </svg>
                <svg className="absolute top-8 left-8 opacity-5 w-32 h-32" viewBox="0 0 100 100" fill="none">
                  <rect x="10" y="10" width="80" height="80" rx="8" stroke="#16B1D4" strokeWidth="1" strokeDasharray="4 4" />
                  <rect x="25" y="25" width="50" height="50" rx="4" stroke="#16B1D4" strokeWidth="1" />
                </svg>

                {/* Content */}
                <div className="absolute inset-0 flex flex-col justify-end p-8 md:p-10">
                  <div className="flex items-center gap-3 mb-5">
                    <span className="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                      style={{ background: "#16B1D4", color: "#fff" }}>
                      {post.category}
                    </span>
                    <span className="flex items-center gap-1.5 text-white/50 text-xs">
                      <Clock className="w-3 h-3" /> 5 min read
                    </span>
                  </div>

                  <h3 className="text-2xl md:text-3xl font-extrabold text-white leading-tight mb-4 group-hover:text-[#16B1D4] transition-colors duration-300">
                    {post.title}
                  </h3>

                  <p className="text-white/60 text-sm line-clamp-2 mb-6 leading-relaxed">
                    {post.excerpt}
                  </p>

                  <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                      <div className="w-8 h-8 rounded-full bg-[#16B1D4]/20 flex items-center justify-center border border-[#16B1D4]/30">
                        <span className="text-[#16B1D4] text-xs font-bold">{post.author.charAt(0)}</span>
                      </div>
                      <div>
                        <p className="text-white text-sm font-semibold">{post.author}</p>
                        <p className="text-white/40 text-xs">{post.authorRole}</p>
                      </div>
                    </div>

                    <Link href={`/blog/${post.slug}`}>
                      <button className="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 group/btn"
                        style={{ background: "rgba(22,177,212,0.15)", color: "#16B1D4", border: "1px solid rgba(22,177,212,0.3)" }}
                        onMouseEnter={e => {
                          (e.currentTarget as HTMLButtonElement).style.background = "#16B1D4";
                          (e.currentTarget as HTMLButtonElement).style.color = "#fff";
                        }}
                        onMouseLeave={e => {
                          (e.currentTarget as HTMLButtonElement).style.background = "rgba(22,177,212,0.15)";
                          (e.currentTarget as HTMLButtonElement).style.color = "#16B1D4";
                        }}>
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
              style={{ background: "rgba(255,255,255,0.1)", border: "1px solid rgba(255,255,255,0.15)" }}>
              <ChevronLeft className="w-4 h-4 text-white" />
            </button>
            <button onClick={next}
              className="absolute right-4 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full flex items-center justify-center transition-all duration-200 opacity-0 group-hover:opacity-100"
              style={{ background: "rgba(255,255,255,0.1)", border: "1px solid rgba(255,255,255,0.15)" }}>
              <ChevronRight className="w-4 h-4 text-white" />
            </button>
          </div>

          {/* Right sidebar — 2 cols */}
          <div className="lg:col-span-2 flex flex-col gap-4">
            {posts.map((p, i) => (
              <motion.div
                key={p.id}
                initial={{ opacity: 0, x: 20 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }}
                transition={{ delay: i * 0.1 }}
                onClick={() => go(i)}
                className="relative rounded-2xl p-5 cursor-pointer transition-all duration-300 group/card flex-1"
                style={{
                  background: active === i
                    ? "rgba(22,177,212,0.12)"
                    : "rgba(255,255,255,0.04)",
                  border: active === i
                    ? "1px solid rgba(22,177,212,0.4)"
                    : "1px solid rgba(255,255,255,0.06)",
                  boxShadow: active === i ? "0 0 0 1px rgba(22,177,212,0.2), inset 0 0 20px rgba(22,177,212,0.05)" : "none",
                }}
              >
                {/* Progress bar for active */}
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
                  {/* Number / icon */}
                  <div className="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300"
                    style={{
                      background: active === i ? "#16B1D4" : "rgba(22,177,212,0.1)",
                      border: active === i ? "none" : "1px solid rgba(22,177,212,0.2)",
                    }}>
                    <span className="text-sm font-black"
                      style={{ color: active === i ? "#fff" : "#16B1D4" }}>
                      0{i + 1}
                    </span>
                  </div>

                  <div className="flex-1 min-w-0">
                    <div className="flex items-center gap-2 mb-2">
                      <span className="text-xs font-bold uppercase tracking-wider"
                        style={{ color: "#16B1D4" }}>
                        {p.category}
                      </span>
                    </div>
                    <p className="text-sm font-semibold text-white/80 leading-snug line-clamp-2 group-hover/card:text-white transition-colors">
                      {p.title}
                    </p>
                    {active === i && (
                      <motion.div
                        initial={{ opacity: 0, height: 0 }}
                        animate={{ opacity: 1, height: "auto" }}
                        className="mt-2"
                      >
                        <p className="text-xs text-white/40 line-clamp-2">{p.excerpt}</p>
                      </motion.div>
                    )}
                  </div>

                  <ArrowRight className="w-4 h-4 shrink-0 transition-all duration-300 opacity-0 group-hover/card:opacity-100"
                    style={{ color: "#16B1D4" }} />
                </div>
              </motion.div>
            ))}

            {/* CTA card */}
            <Link href="/blog">
              <div className="rounded-2xl p-5 cursor-pointer transition-all duration-300 group/cta flex items-center justify-between"
                style={{
                  background: "linear-gradient(135deg, rgba(22,177,212,0.15), rgba(16,26,106,0.3))",
                  border: "1px solid rgba(22,177,212,0.25)",
                }}>
                <div>
                  <p className="text-white font-bold text-sm">Explore All Articles</p>
                  <p className="text-white/40 text-xs mt-0.5">15+ expert guides &amp; case studies</p>
                </div>
                <div className="w-9 h-9 rounded-full flex items-center justify-center shrink-0 transition-all duration-300 group-hover/cta:scale-110"
                  style={{ background: "#16B1D4" }}>
                  <ArrowRight className="w-4 h-4 text-white" />
                </div>
              </div>
            </Link>
          </div>
        </div>

        {/* Dot nav */}
        <div className="flex justify-center gap-2 mt-8">
          {posts.map((_, i) => (
            <button
              key={i}
              onClick={() => go(i)}
              className="transition-all duration-300 rounded-full"
              style={{
                width: active === i ? "2rem" : "0.5rem",
                height: "0.5rem",
                background: active === i ? "#16B1D4" : "rgba(255,255,255,0.2)",
              }}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
