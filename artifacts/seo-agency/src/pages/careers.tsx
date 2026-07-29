import { Link } from "wouter";
import { motion } from "framer-motion";
import { Button } from "@/components/ui/button";
import {
  TrendingUp, Users, Globe, Zap, Heart, GraduationCap,
  DollarSign, Monitor, Coffee, Plane, ArrowRight, CheckCircle2
} from "lucide-react";

const VALUES = [
  {
    icon: TrendingUp,
    title: "Performance Obsessed",
    desc: "Every team member owns their numbers. We celebrate wins backed by data, not just effort.",
  },
  {
    icon: Users,
    title: "Radical Collaboration",
    desc: "SEOs, designers, developers, and strategists work in tight pods. Silos kill creativity.",
  },
  {
    icon: Globe,
    title: "Global Mindset",
    desc: "We serve clients across 15+ countries. Curiosity about different markets is in our DNA.",
  },
  {
    icon: Zap,
    title: "Move Fast, Stay Sharp",
    desc: "Google's algorithm waits for no one. We ship, iterate, and stay ahead — always.",
  },
];

const BENEFITS = [
  { icon: DollarSign, title: "Competitive Salary",     desc: "Market-leading compensation benchmarked quarterly against UAE digital agency standards." },
  { icon: TrendingUp, title: "Performance Bonuses",    desc: "Quarterly bonuses tied to client results and personal KPIs — when clients win, you win." },
  { icon: Monitor,    title: "Remote Flexibility",     desc: "Hybrid work model. Dubai HQ for collaboration, WFH for deep work. Up to 2 days remote/week." },
  { icon: GraduationCap, title: "Learning Budget",     desc: "AED 5,000/year for courses, conferences, tools, or certifications of your choice." },
  { icon: Heart,      title: "Health Insurance",       desc: "Comprehensive UAE health insurance for you and your immediate family." },
  { icon: Coffee,     title: "Premium Office",         desc: "Modern Deira workspace with standing desks, fast internet, unlimited specialty coffee, and a library." },
  { icon: Plane,      title: "Annual Leave",           desc: "30 days annual leave plus UAE public holidays. We mean it — we actively encourage you to disconnect." },
  { icon: Globe,      title: "Visa Sponsorship",       desc: "Full UAE employment visa, Emirates ID, and labour card handled for you from day one." },
];

const DEPARTMENTS = [
  {
    name: "SEO & Content",
    roles: ["Senior Technical SEO Specialist", "Content Strategist", "Link Building Specialist"],
    open: false,
  },
  {
    name: "Paid Media",
    roles: ["Google Ads Manager", "Programmatic Display Specialist", "Paid Social Specialist"],
    open: false,
  },
  {
    name: "Design & Development",
    roles: ["UI/UX Designer", "Frontend Developer (React)", "WordPress Developer"],
    open: false,
  },
  {
    name: "Strategy & Accounts",
    roles: ["Digital Strategist", "Senior Account Manager", "Business Development Executive"],
    open: false,
  },
];

const HIRING_STEPS = [
  { step: "01", title: "Application Review",  desc: "We review every application personally. No automated rejections." },
  { step: "02", title: "Intro Call (30 min)", desc: "A quick chat about your experience, goals, and what excites you about digital marketing." },
  { step: "03", title: "Skills Assessment",   desc: "A real-world task relevant to the role. Usually 2–3 hours. We pay for your time." },
  { step: "04", title: "Team Interview",      desc: "Meet the people you'd work with. We're assessing fit both ways." },
  { step: "05", title: "Offer",               desc: "Fast decisions — we don't keep great candidates waiting." },
];

export default function Careers() {
  return (
    <div className="flex flex-col min-h-screen bg-background">

      {/* Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="absolute top-0 right-0 w-[500px] h-[500px] rounded-full opacity-10 blur-3xl pointer-events-none"
          style={{ background: "radial-gradient(circle, #16B1D4, transparent 70%)" }} />
        <div className="container mx-auto px-4 relative z-10 grid lg:grid-cols-2 gap-16 items-center">
          <motion.div initial={{ opacity: 0, y: 24 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }}>
            <div className="section-label mb-6 text-white border-white/20 bg-white/10">Careers at SEO.ae</div>
            <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6 tracking-tight leading-tight">
              Build the Future<br />
              of <span style={{
                background: "linear-gradient(135deg, #16B1D4, #7dd8ef)",
                WebkitBackgroundClip: "text",
                WebkitTextFillColor: "transparent",
                backgroundClip: "text",
              }}>Digital Growth</span>
            </h1>
            <p className="text-xl text-white/70 mb-10 leading-relaxed font-light">
              We're not looking for people who want a job. We're looking for people who want to build something exceptional. Join 40+ digital experts shaping how brands grow in the AI era.
            </p>
            <div className="flex flex-wrap gap-6">
              {["40+ Team Members", "15+ Countries Served", "1,200+ Campaigns", "Dubai HQ"].map((stat) => (
                <div key={stat} className="flex items-center gap-2 text-white/70">
                  <CheckCircle2 className="w-4 h-4 shrink-0" style={{ color: "#16B1D4" }} />
                  <span className="text-sm font-semibold">{stat}</span>
                </div>
              ))}
            </div>
          </motion.div>

          {/* Right: values grid */}
          <div className="grid grid-cols-2 gap-4">
            {VALUES.map((v, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.2 + i * 0.1 }}
                className="glass-panel-dark rounded-2xl p-5"
              >
                <v.icon className="w-7 h-7 mb-3" style={{ color: "#16B1D4" }} />
                <h3 className="text-white font-bold text-base mb-1">{v.title}</h3>
                <p className="text-white/50 text-xs leading-relaxed">{v.desc}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Benefits */}
      <section className="py-24 bg-background bg-grid-pattern">
        <div className="container mx-auto px-4">
          <motion.div initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }}
            className="text-center max-w-2xl mx-auto mb-16">
            <div className="section-label">Why Join Us</div>
            <h2 className="text-4xl font-extrabold text-foreground mt-4 mb-4">Life at SEO.ae</h2>
            <p className="text-muted-foreground text-lg">We invest in our people because our people deliver exceptional results for clients.</p>
          </motion.div>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            {BENEFITS.map((b, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }} transition={{ delay: i * 0.07 }}
                className="card-lift p-6 group"
              >
                <div className="w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform"
                  style={{ background: "rgba(22,177,212,0.1)", border: "1px solid rgba(22,177,212,0.2)" }}>
                  <b.icon className="w-6 h-6" style={{ color: "#16B1D4" }} />
                </div>
                <h3 className="font-bold text-foreground mb-2">{b.title}</h3>
                <p className="text-sm text-muted-foreground leading-relaxed">{b.desc}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Open positions */}
      <section className="py-24 bg-muted/30 border-y border-border">
        <div className="container mx-auto px-4">
          <motion.div initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }}
            className="text-center max-w-2xl mx-auto mb-16">
            <div className="section-label">Open Roles</div>
            <h2 className="text-4xl font-extrabold text-foreground mt-4 mb-4">Current Openings</h2>
            <p className="text-muted-foreground text-lg">
              We don't have specific vacancies open right now — but we're a fast-growing agency and that changes often.
            </p>
          </motion.div>

          <div className="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-12">
            {DEPARTMENTS.map((dept, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 16 }} whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }} transition={{ delay: i * 0.1 }}
                className="card-lift p-6"
              >
                <div className="flex items-center justify-between mb-4">
                  <h3 className="font-extrabold text-foreground text-lg">{dept.name}</h3>
                  <span className="px-3 py-1 rounded-full text-xs font-bold"
                    style={{ background: "rgba(22,177,212,0.1)", color: "#16B1D4" }}>
                    {dept.open ? "Hiring" : "Watch this space"}
                  </span>
                </div>
                <ul className="space-y-2">
                  {dept.roles.map((role) => (
                    <li key={role} className="flex items-center gap-2 text-sm text-muted-foreground">
                      <div className="w-1.5 h-1.5 rounded-full shrink-0" style={{ background: "#16B1D4" }} />
                      {role}
                    </li>
                  ))}
                </ul>
              </motion.div>
            ))}
          </div>

          {/* General application CTA */}
          <div className="max-w-2xl mx-auto rounded-3xl p-10 text-center border border-border bg-white shadow-sm">
            <div className="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5"
              style={{ background: "rgba(22,177,212,0.1)", border: "1px solid rgba(22,177,212,0.25)" }}>
              <Users className="w-8 h-8" style={{ color: "#16B1D4" }} />
            </div>
            <h3 className="text-2xl font-extrabold text-foreground mb-3">Don't See Your Role?</h3>
            <p className="text-muted-foreground mb-8 leading-relaxed">
              Exceptional people make their own opportunities. If you're outstanding at what you do in SEO, paid media, design, or development, we want to hear from you. Send us your portfolio and tell us what you'd build here.
            </p>
            <Link href="/contact">
              <Button size="lg" className="h-13 px-8 gap-2 font-bold"
                style={{ background: "#16B1D4", color: "#fff" }}>
                Send General Application <ArrowRight className="w-5 h-5" />
              </Button>
            </Link>
          </div>
        </div>
      </section>

      {/* Hiring process */}
      <section className="py-24 bg-background">
        <div className="container mx-auto px-4">
          <motion.div initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }}
            className="text-center max-w-2xl mx-auto mb-16">
            <div className="section-label">Our Process</div>
            <h2 className="text-4xl font-extrabold text-foreground mt-4 mb-4">How We Hire</h2>
            <p className="text-muted-foreground text-lg">Respectful, transparent, and fast. No ghost rounds or pointless puzzle interviews.</p>
          </motion.div>

          <div className="max-w-3xl mx-auto">
            {HIRING_STEPS.map((s, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, x: -20 }} whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }} transition={{ delay: i * 0.1 }}
                className="flex gap-6 pb-8 last:pb-0"
              >
                <div className="flex flex-col items-center shrink-0">
                  <div className="w-12 h-12 rounded-2xl flex items-center justify-center font-black text-sm shrink-0"
                    style={{ background: "#101A6A", color: "#fff" }}>
                    {s.step}
                  </div>
                  {i < HIRING_STEPS.length - 1 && (
                    <div className="w-0.5 flex-1 mt-3" style={{ background: "rgba(22,177,212,0.2)" }} />
                  )}
                </div>
                <div className="pt-2 pb-2">
                  <h3 className="font-extrabold text-foreground text-lg mb-1">{s.title}</h3>
                  <p className="text-muted-foreground leading-relaxed">{s.desc}</p>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="py-24 hero-dark bg-grid-pattern-dark relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 text-center">
          <h2 className="text-4xl md:text-5xl font-extrabold text-white mb-5">Ready to Do the Best Work of Your Career?</h2>
          <p className="text-xl text-white/70 max-w-2xl mx-auto mb-10 font-light">
            Join a team that's rewriting what's possible in digital growth. Your next challenge is here.
          </p>
          <Link href="/contact">
            <Button size="lg" className="h-14 px-10 text-lg gap-2 font-bold"
              style={{ background: "#16B1D4", color: "#fff", boxShadow: "0 8px 30px rgba(22,177,212,0.4)" }}>
              Apply Now <ArrowRight className="w-5 h-5" />
            </Button>
          </Link>
        </div>
      </section>
    </div>
  );
}
