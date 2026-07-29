import { 
  useGetAgencyStats, 
  useGetFeaturedContent 
} from "@workspace/api-client-react";
import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Counter } from "@/components/ui/counter";
import { Skeleton } from "@/components/ui/skeleton";
import { TestimonialSlider } from "@/components/TestimonialSlider";
import { motion } from "framer-motion";
import { ArrowRight, BarChart, ChevronRight, Code, PenTool, Search, Smartphone, TrendingUp } from "lucide-react";
import { Card } from "@/components/ui/card";

export default function Home() {
  const { data: stats, isLoading: statsLoading } = useGetAgencyStats();
  const { data: featured, isLoading: featuredLoading } = useGetFeaturedContent();

  return (
    <div className="flex flex-col min-h-screen">
      {/* Hero Section */}
      <section className="hero-dark bg-grid-pattern-dark relative min-h-[90dvh] flex items-center pt-20 overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img 
            src="/attached_assets/generated_images/dubai-hero.jpg" 
            alt="Dubai Skyline Digital Node Network" 
            className="w-full h-full object-cover opacity-20 object-center mix-blend-overlay"
            onError={(e) => {
              e.currentTarget.style.display = 'none';
            }}
          />
          <div className="absolute inset-0 bg-gradient-to-b from-transparent to-secondary/90" />
        </div>

        <div className="container relative z-10 mx-auto px-4">
          <div className="max-w-4xl">
            <motion.div
              initial={{ opacity: 0, y: 24 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
            >
              <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold uppercase tracking-widest mb-6">
                <span className="relative flex h-2 w-2">
                  <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                  <span className="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                </span>
                Dubai's #1 Enterprise SEO & Growth Partner
              </div>
              
              <h1 className="text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight text-white leading-[1.1] mb-8">
                Dominate <span className="gradient-text-primary">Search.</span><br />
                Scale Revenue.
              </h1>
              
              <p className="text-lg md:text-xl text-white/70 max-w-2xl mb-10 leading-relaxed font-light">
                We don't just chase rankings. We architect digital dominance. Leveraging AI-driven SEO, high-converting design, and precision paid media to turn your business into a market leader.
              </p>
              
              <div className="flex flex-col sm:flex-row gap-4 mb-16">
                <Link href="/contact">
                  <Button size="lg" className="w-full sm:w-auto gap-2 text-base h-14 px-8">
                    Get Free Audit <ArrowRight className="w-5 h-5" />
                  </Button>
                </Link>
                <Link href="/portfolio">
                  <Button variant="inverted" size="lg" className="w-full sm:w-auto h-14 px-8 text-base">
                    View Our Work
                  </Button>
                </Link>
              </div>

              {/* Stats Counters in Hero */}
              <div className="grid grid-cols-2 md:grid-cols-4 gap-6 pt-10 border-t border-white/10">
                {statsLoading ? (
                  [1, 2, 3, 4].map(i => <Skeleton key={i} className="h-16 bg-white/10" />)
                ) : stats ? (
                  <>
                    <div>
                      <div className="text-3xl md:text-4xl font-bold text-white mb-1 font-mono">
                        <Counter value={stats.averageRoiIncrease} prefix="+" suffix="%" />
                      </div>
                      <div className="text-xs font-bold text-accent uppercase tracking-wider">Avg. ROI Increase</div>
                    </div>
                    <div>
                      <div className="text-3xl md:text-4xl font-bold text-white mb-1 font-mono">
                        <Counter value={stats.projectsCompleted} suffix="+" />
                      </div>
                      <div className="text-xs font-bold text-accent uppercase tracking-wider">Projects Delivered</div>
                    </div>
                    <div>
                      <div className="text-3xl md:text-4xl font-bold text-white mb-1 font-mono">
                        <Counter value={stats.googleRating} suffix="/5" />
                      </div>
                      <div className="text-xs font-bold text-accent uppercase tracking-wider">Google Rating</div>
                    </div>
                    <div>
                      <div className="text-3xl md:text-4xl font-bold text-white mb-1 font-mono">
                        <Counter value={stats.yearsExperience} suffix="+" />
                      </div>
                      <div className="text-xs font-bold text-accent uppercase tracking-wider">Years Experience</div>
                    </div>
                  </>
                ) : null}
              </div>
            </motion.div>
          </div>
        </div>
      </section>

      {/* Services Grid */}
      <section className="py-32 bg-background bg-grid-pattern relative">
        <div className="container mx-auto px-4">
          <div className="text-center max-w-3xl mx-auto mb-20">
            <div className="section-label">Our Expertise</div>
            <h3 className="text-4xl md:text-5xl font-bold text-foreground mb-6">Full-Spectrum Digital Growth</h3>
            <p className="text-muted-foreground text-lg">We orchestrate multi-channel strategies that compound over time, turning your digital presence into your most valuable asset.</p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {[
              { title: "Enterprise SEO", icon: TrendingUp, desc: "Data-driven organic growth strategies that capture high-intent search real estate and drive compounding revenue.", link: "/services/seo" },
              { title: "AI Search Optimization", icon: Search, desc: "Prepare for the future of search. Optimization for LLMs, ChatGPT, and AI Overviews to keep you visible everywhere.", link: "/services/ai-search-optimization" },
              { title: "PPC Campaigns", icon: BarChart, desc: "Hyper-targeted Google Ads and paid media strategies engineered for maximum ROAS and immediate lead generation.", link: "/services/ppc" },
              { title: "Social Media", icon: Smartphone, desc: "Scroll-stopping content and community management that builds brand authority and loyal audiences.", link: "/services/social-media-marketing" },
              { title: "Premium Web Design", icon: PenTool, desc: "High-end, conversion-optimized interfaces that command trust and elevate your brand perception instantly.", link: "/services/web-design" },
              { title: "Web Development", icon: Code, desc: "Lightning-fast, scalable web applications built on modern stacks like React, Next.js, and headless CMS.", link: "/services/web-development" },
            ].map((service, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: i * 0.1 }}
              >
                <Link href={service.link}>
                  <div className="card-lift h-full group p-8 relative overflow-hidden">
                    <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity" />
                    <div className="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                      <service.icon className="w-7 h-7 text-primary" />
                    </div>
                    <h4 className="text-2xl font-bold text-foreground mb-4 group-hover:text-primary transition-colors">{service.title}</h4>
                    <p className="text-muted-foreground mb-6 line-clamp-3">{service.desc}</p>
                    <div className="flex items-center text-primary font-bold text-sm gap-2 mt-auto">
                      Explore Service <ChevronRight className="w-4 h-4 group-hover:translate-x-2 transition-transform" />
                    </div>
                  </div>
                </Link>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Why Choose Us */}
      <section className="py-24 bg-muted/30 border-y border-border">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-16 items-center">
            <div>
              <div className="section-label">Why SEO.ae</div>
              <h2 className="text-4xl font-bold text-foreground mb-6">We Turn Clicks Into Revenue</h2>
              <p className="text-lg text-muted-foreground mb-8">
                Stop paying for vanity metrics. We focus on what actually matters: qualified leads, pipeline growth, and bottom-line revenue.
              </p>
              <ul className="space-y-4">
                {[
                  "Data-backed decisions, not guesswork",
                  "Elite technical execution",
                  "Transparent reporting aligned to business goals",
                  "Agile strategies that adapt to market shifts"
                ].map((item, i) => (
                  <li key={i} className="flex items-center gap-3 text-foreground font-medium">
                    <div className="w-6 h-6 rounded-full bg-primary/20 flex items-center justify-center shrink-0">
                      <div className="w-2 h-2 rounded-full bg-primary" />
                    </div>
                    {item}
                  </li>
                ))}
              </ul>
            </div>
            <div className="relative">
              <div className="absolute inset-0 bg-primary/5 rounded-3xl -rotate-6 transform scale-105" />
              <img src="/attached_assets/generated_images/ai-brain.jpg" alt="Growth Strategy" className="rounded-3xl relative z-10 shadow-lg object-cover h-[500px] w-full" onError={(e) => e.currentTarget.style.display = 'none'} />
            </div>
          </div>
        </div>
      </section>

      {/* Featured Case Studies */}
      <section className="py-32 bg-background relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10">
          <div className="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div className="max-w-2xl">
              <div className="section-label">Proven Results</div>
              <h3 className="text-4xl md:text-5xl font-bold text-foreground">We Build Market Leaders</h3>
            </div>
            <Link href="/case-studies">
              <Button variant="outline" className="hidden md:flex gap-2">
                View All Case Studies <ArrowRight className="w-4 h-4" />
              </Button>
            </Link>
          </div>

          {featuredLoading ? (
            <div className="grid md:grid-cols-2 gap-8">
              <Skeleton className="h-[400px] rounded-2xl" />
              <Skeleton className="h-[400px] rounded-2xl" />
            </div>
          ) : featured?.caseStudies ? (
            <div className="grid md:grid-cols-2 gap-8">
              {featured.caseStudies.slice(0, 2).map((cs) => (
                <Link key={cs.id} href={`/case-studies/${cs.slug}`}>
                  <Card className="group overflow-hidden bg-white border-border hover:border-primary/50 hover:shadow-lg transition-all h-full flex flex-col">
                    <div className="aspect-video relative overflow-hidden bg-muted">
                      {cs.featuredImage ? (
                         <img src={cs.featuredImage} alt={cs.clientName} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                      ) : (
                         <div className="w-full h-full flex items-center justify-center text-muted-foreground font-bold text-2xl bg-muted/50">
                           {cs.clientName}
                         </div>
                      )}
                      <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent" />
                      <div className="absolute bottom-6 left-6">
                        <div className="px-3 py-1 bg-primary text-white text-xs font-bold rounded-full mb-3 inline-block uppercase tracking-wider">
                          {cs.service}
                        </div>
                        <h4 className="text-2xl font-bold text-white">{cs.clientName}</h4>
                      </div>
                    </div>
                    <div className="p-8 flex-1 flex flex-col justify-between">
                      <p className="text-muted-foreground mb-6 font-medium">{cs.challenge}</p>
                      <div className="grid grid-cols-2 gap-4">
                        {cs.results.slice(0, 2).map((r, i) => (
                          <div key={i} className="border-l-4 border-primary pl-4 py-1 bg-muted/30 rounded-r-lg">
                            <div className="text-2xl font-black text-secondary">{r.value}</div>
                            <div className="text-xs font-bold text-muted-foreground uppercase tracking-wider mt-1">{r.label}</div>
                          </div>
                        ))}
                      </div>
                    </div>
                  </Card>
                </Link>
              ))}
            </div>
          ) : null}
          
          <div className="mt-10 text-center md:hidden">
            <Link href="/case-studies">
              <Button variant="outline" className="w-full h-12">View All Case Studies</Button>
            </Link>
          </div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="py-32 bg-muted/30 border-y border-border">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <div className="section-label">Client Voices</div>
            <h3 className="text-4xl font-bold text-foreground">Don't Just Take Our Word For It</h3>
          </div>
          
          {featuredLoading ? (
            <Skeleton className="w-full max-w-4xl mx-auto h-64 rounded-2xl" />
          ) : featured?.testimonials ? (
            <TestimonialSlider testimonials={featured.testimonials} />
          ) : null}
        </div>
      </section>

      {/* Dark CTA Section */}
      <section className="py-32 hero-dark bg-grid-pattern-dark relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 text-center">
          <h2 className="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">Ready to dominate your market?</h2>
          <p className="text-xl text-white/80 max-w-2xl mx-auto mb-10 font-light">
            Stop losing customers to competitors with inferior products but better visibility. Claim your unfair advantage today.
          </p>
          <div className="flex flex-col sm:flex-row justify-center gap-4">
            <Link href="/contact">
              <Button size="lg" className="h-14 px-10 text-lg w-full sm:w-auto">
                Get Your Free Growth Audit
              </Button>
            </Link>
            <Link href="/services">
              <Button size="lg" variant="inverted" className="h-14 px-10 text-lg w-full sm:w-auto">
                Explore Services
              </Button>
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
}