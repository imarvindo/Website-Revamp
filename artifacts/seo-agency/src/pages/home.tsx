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
import { ArrowRight, BarChart, ChevronRight, Code, Globe, PenTool, Search, Smartphone, TrendingUp, Users } from "lucide-react";
import { Card } from "@/components/ui/card";

// Using the provided generated image path from instructions/mind
import heroBg from "@assets/generated_images/dubai-hero.jpg";

export default function Home() {
  const { data: stats, isLoading: statsLoading } = useGetAgencyStats();
  const { data: featured, isLoading: featuredLoading } = useGetFeaturedContent();

  return (
    <div className="flex flex-col min-h-screen">
      {/* Hero Section */}
      <section className="relative min-h-[100dvh] flex items-center pt-20 overflow-hidden">
        {/* Background Image with Overlay */}
        <div className="absolute inset-0 z-0">
          <img 
            src="/attached_assets/generated_images/dubai-hero.jpg" 
            alt="Dubai Skyline Digital Node Network" 
            className="w-full h-full object-cover opacity-30 object-center"
            onError={(e) => {
              // Fallback if image doesn't exist yet
              e.currentTarget.style.display = 'none';
            }}
          />
          <div className="absolute inset-0 bg-gradient-to-b from-background/40 via-background/80 to-background" />
          <div className="absolute inset-0 bg-grid-pattern opacity-50" />
        </div>

        <div className="container relative z-10 mx-auto px-4">
          <div className="max-w-4xl">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, ease: "easeOut" }}
            >
              <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary text-sm font-medium mb-6">
                <span className="relative flex h-2 w-2">
                  <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                  <span className="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                </span>
                Dubai's #1 Enterprise SEO & Growth Partner
              </div>
              
              <h1 className="text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight text-white leading-[1.1] mb-8">
                Dominate <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-400">Search.</span><br />
                Scale <span className="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-200">Revenue.</span>
              </h1>
              
              <p className="text-lg md:text-xl text-white/70 max-w-2xl mb-10 leading-relaxed font-light">
                We don't just chase rankings. We architect digital dominance. Leveraging AI-driven SEO, high-converting design, and precision paid media to turn your business into a market leader.
              </p>
              
              <div className="flex flex-col sm:flex-row gap-4">
                <Link href="/contact">
                  <Button size="lg" className="w-full sm:w-auto gap-2 text-base h-14">
                    Claim Your Free Audit <ArrowRight className="w-5 h-5" />
                  </Button>
                </Link>
                <Link href="/case-studies">
                  <Button variant="outline" size="lg" className="w-full sm:w-auto h-14 text-base">
                    View Our Impact
                  </Button>
                </Link>
              </div>
            </motion.div>
          </div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="py-20 border-y border-white/5 bg-white/[0.02] relative z-10 -mt-20 backdrop-blur-sm">
        <div className="container mx-auto px-4">
          {statsLoading ? (
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
              {[1, 2, 3, 4].map(i => <Skeleton key={i} className="h-24" />)}
            </div>
          ) : stats ? (
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-white/5">
              <div className="text-center px-4">
                <div className="text-4xl md:text-5xl font-bold text-white mb-2 font-mono">
                  <Counter value={stats.averageRoiIncrease} prefix="+" suffix="%" />
                </div>
                <div className="text-sm font-medium text-primary uppercase tracking-wider">Avg. ROI Increase</div>
              </div>
              <div className="text-center px-4">
                <div className="text-4xl md:text-5xl font-bold text-white mb-2 font-mono">
                  <Counter value={stats.projectsCompleted} suffix="+" />
                </div>
                <div className="text-sm font-medium text-primary uppercase tracking-wider">Projects Delivered</div>
              </div>
              <div className="text-center px-4">
                <div className="text-4xl md:text-5xl font-bold text-white mb-2 font-mono">
                  <Counter value={stats.googleRating} suffix="/5" />
                </div>
                <div className="text-sm font-medium text-primary uppercase tracking-wider">Google Rating</div>
              </div>
              <div className="text-center px-4">
                <div className="text-4xl md:text-5xl font-bold text-white mb-2 font-mono">
                  <Counter value={stats.yearsExperience} suffix="+" />
                </div>
                <div className="text-sm font-medium text-primary uppercase tracking-wider">Years Experience</div>
              </div>
            </div>
          ) : null}
        </div>
      </section>

      {/* Services Grid */}
      <section className="py-32 relative">
        <div className="container mx-auto px-4">
          <div className="text-center max-w-3xl mx-auto mb-20">
            <h2 className="text-sm font-bold text-accent tracking-widest uppercase mb-4">Our Expertise</h2>
            <h3 className="text-4xl md:text-5xl font-bold text-white mb-6">Full-Spectrum Digital Growth</h3>
            <p className="text-white/60 text-lg">We orchestrate multi-channel strategies that compound over time, turning your digital presence into your most valuable asset.</p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {[
              { title: "Enterprise SEO", icon: TrendingUp, desc: "Data-driven organic growth strategies that capture high-intent search real estate and drive compounding revenue.", link: "/seo" },
              { title: "AI Search Optimization", icon: Search, desc: "Prepare for the future of search. Optimization for LLMs, ChatGPT, and AI Overviews to keep you visible everywhere.", link: "/ai-search-optimization" },
              { title: "PPC Campaigns", icon: BarChart, desc: "Hyper-targeted Google Ads and paid media strategies engineered for maximum ROAS and immediate lead generation.", link: "/ppc" },
              { title: "Social Media", icon: Smartphone, desc: "Scroll-stopping content and community management that builds brand authority and loyal audiences.", link: "/social-media-marketing" },
              { title: "Premium Web Design", icon: PenTool, desc: "High-end, conversion-optimized interfaces that command trust and elevate your brand perception instantly.", link: "/web-design" },
              { title: "Web Development", icon: Code, desc: "Lightning-fast, scalable web applications built on modern stacks like React, Next.js, and headless CMS.", link: "/web-development" },
            ].map((service, i) => (
              <Link key={i} href={service.link}>
                <Card className="group h-full hover:bg-white/10 transition-colors border-white/5 hover:border-primary/50 relative overflow-hidden">
                  <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity" />
                  <div className="p-8">
                    <div className="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                      <service.icon className="w-7 h-7 text-primary" />
                    </div>
                    <h4 className="text-2xl font-bold text-white mb-4 group-hover:text-primary transition-colors">{service.title}</h4>
                    <p className="text-white/60 mb-6 line-clamp-3">{service.desc}</p>
                    <div className="flex items-center text-primary font-medium text-sm gap-2">
                      Explore Service <ChevronRight className="w-4 h-4 group-hover:translate-x-2 transition-transform" />
                    </div>
                  </div>
                </Card>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Featured Case Studies */}
      <section className="py-32 bg-secondary/50 border-y border-white/5 relative overflow-hidden">
        <div className="absolute top-1/2 left-0 w-96 h-96 bg-primary/10 rounded-full blur-[120px] -translate-y-1/2" />
        
        <div className="container mx-auto px-4 relative z-10">
          <div className="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div className="max-w-2xl">
              <h2 className="text-sm font-bold text-accent tracking-widest uppercase mb-4">Proven Results</h2>
              <h3 className="text-4xl md:text-5xl font-bold text-white">We Build Market Leaders</h3>
            </div>
            <Link href="/case-studies">
              <Button variant="outline" className="hidden md:flex gap-2">
                View All Case Studies <ArrowRight className="w-4 h-4" />
              </Button>
            </Link>
          </div>

          {featuredLoading ? (
            <div className="grid md:grid-cols-2 gap-8">
              <Skeleton className="h-[400px]" />
              <Skeleton className="h-[400px]" />
            </div>
          ) : featured?.caseStudies ? (
            <div className="grid md:grid-cols-2 gap-8">
              {featured.caseStudies.slice(0, 2).map((cs) => (
                <Link key={cs.id} href={`/case-studies/${cs.slug}`}>
                  <Card className="group overflow-hidden border-white/10 hover:border-primary/50 transition-colors h-full flex flex-col">
                    <div className="aspect-video relative overflow-hidden bg-white/5">
                      {cs.featuredImage ? (
                        <img src={cs.featuredImage} alt={cs.clientName} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                      ) : (
                        <div className="w-full h-full flex items-center justify-center text-white/20 font-bold text-2xl bg-gradient-to-br from-secondary to-background">
                          {cs.clientName}
                        </div>
                      )}
                      <div className="absolute inset-0 bg-gradient-to-t from-background via-background/20 to-transparent opacity-80" />
                      <div className="absolute bottom-6 left-6">
                        <div className="px-3 py-1 bg-primary/20 backdrop-blur-md text-primary text-xs font-bold rounded-full mb-3 inline-block uppercase tracking-wider">
                          {cs.service}
                        </div>
                        <h4 className="text-2xl font-bold text-white">{cs.clientName}</h4>
                      </div>
                    </div>
                    <div className="p-6 flex-1 flex flex-col justify-between">
                      <p className="text-white/70 mb-6">{cs.challenge}</p>
                      <div className="grid grid-cols-2 gap-4">
                        {cs.results.slice(0, 2).map((r, i) => (
                          <div key={i} className="border-l-2 border-primary pl-4">
                            <div className="text-2xl font-bold text-white">{r.value}</div>
                            <div className="text-xs text-white/50 uppercase tracking-wider mt-1">{r.label}</div>
                          </div>
                        ))}
                      </div>
                    </div>
                  </Card>
                </Link>
              ))}
            </div>
          ) : null}
          
          <div className="mt-8 text-center md:hidden">
            <Link href="/case-studies">
              <Button variant="outline" className="w-full">View All Case Studies</Button>
            </Link>
          </div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="py-32">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <h2 className="text-sm font-bold text-accent tracking-widest uppercase mb-4">Client Voices</h2>
            <h3 className="text-4xl font-bold text-white">Don't Just Take Our Word For It</h3>
          </div>
          
          {featuredLoading ? (
            <Skeleton className="w-full max-w-4xl mx-auto h-64 rounded-2xl" />
          ) : featured?.testimonials ? (
            <TestimonialSlider testimonials={featured.testimonials} />
          ) : null}
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-32 relative overflow-hidden bg-primary">
        <div className="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay" />
        <div className="absolute top-0 right-0 w-[800px] h-[800px] bg-white/20 rounded-full blur-[150px] -translate-y-1/2 translate-x-1/3" />
        
        <div className="container mx-auto px-4 relative z-10 text-center">
          <h2 className="text-4xl md:text-6xl font-extrabold text-white mb-6">Ready to dominate your market?</h2>
          <p className="text-xl text-white/90 max-w-2xl mx-auto mb-10">
            Stop losing customers to competitors with inferior products but better SEO. Claim your unfair advantage today.
          </p>
          <div className="flex flex-col sm:flex-row justify-center gap-4">
            <Link href="/contact">
              <Button size="lg" variant="gold" className="h-14 px-8 text-lg w-full sm:w-auto">
                Get Your Free Growth Audit
              </Button>
            </Link>
            <Link href="/services">
              <Button size="lg" className="h-14 px-8 text-lg w-full sm:w-auto bg-black text-white hover:bg-black/80 border-0">
                Explore Services
              </Button>
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
}