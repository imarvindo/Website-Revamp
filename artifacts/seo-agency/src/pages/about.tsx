import { useGetAgencyStats } from "@workspace/api-client-react";
import { Counter } from "@/components/ui/counter";
import { Skeleton } from "@/components/ui/skeleton";
import { Award, Target, Users, Zap } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Link } from "wouter";

export default function About() {
  const { data: stats, isLoading } = useGetAgencyStats();

  return (
    <div className="flex flex-col min-h-screen">
      {/* Dark Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-20 relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 grid lg:grid-cols-2 gap-16 items-center">
          <div>
            <div className="section-label mb-6 text-white border-white/20 bg-white/10">About Us</div>
            <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6">
              We Don't Guess.<br />
              <span className="gradient-text-primary">We Dominate.</span>
            </h1>
            <p className="text-xl text-white/70 leading-relaxed mb-8">
              Founded in Dubai, SEO.ae was built on a singular premise: most agencies deliver reports, we deliver revenue. We combine elite technical expertise with aggressive growth strategies to turn businesses into market leaders.
            </p>
            <div className="flex items-center gap-6">
              <div className="flex -space-x-4">
                {[1,2,3,4].map(i => (
                  <div key={i} className="w-12 h-12 rounded-full border-2 border-secondary bg-primary flex items-center justify-center overflow-hidden">
                    <img src={`https://i.pravatar.cc/100?img=${i+10}`} alt="Team member" />
                  </div>
                ))}
              </div>
              <div className="text-sm text-white/60">
                <strong className="text-white text-lg">40+</strong><br/>Digital Experts
              </div>
            </div>
          </div>
          <div className="relative">
            <div className="aspect-square rounded-full bg-primary/20 blur-[100px] absolute inset-0" />
            <div className="grid grid-cols-2 gap-4 relative z-10">
              <div className="space-y-4 pt-12">
                <div className="glass-panel-dark p-6 rounded-2xl">
                  <Target className="w-8 h-8 text-primary mb-4" />
                  <h3 className="text-xl font-bold text-white mb-2">Precision</h3>
                  <p className="text-sm text-white/60">Every campaign is backed by hard data and deep market analysis.</p>
                </div>
                <div className="glass-panel-dark p-6 rounded-2xl">
                  <Zap className="w-8 h-8 text-accent mb-4" />
                  <h3 className="text-xl font-bold text-white mb-2">Speed</h3>
                  <p className="text-sm text-white/60">We move faster than your competitors can react.</p>
                </div>
              </div>
              <div className="space-y-4">
                <div className="glass-panel-dark p-6 rounded-2xl">
                  <Award className="w-8 h-8 text-warning mb-4" />
                  <h3 className="text-xl font-bold text-white mb-2">Excellence</h3>
                  <p className="text-sm text-white/60">Award-winning strategies that consistently break records.</p>
                </div>
                <div className="glass-panel-dark p-6 rounded-2xl">
                  <Users className="w-8 h-8 text-primary mb-4" />
                  <h3 className="text-xl font-bold text-white mb-2">Partnership</h3>
                  <p className="text-sm text-white/60">We treat your business and budget like it's our own.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Stats - Light Theme */}
      <section className="py-24 border-b border-border bg-white">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
              {[1, 2, 3, 4].map(i => <Skeleton key={i} className="h-24 bg-muted" />)}
            </div>
          ) : stats ? (
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-border">
              <div>
                <div className="text-4xl md:text-5xl font-extrabold text-secondary mb-2 font-mono">
                  <Counter value={stats.yearsExperience} suffix="+" />
                </div>
                <div className="text-muted-foreground uppercase tracking-widest text-xs font-bold">Years Active</div>
              </div>
              <div>
                <div className="text-4xl md:text-5xl font-extrabold text-secondary mb-2 font-mono">
                  <Counter value={stats.clientsServed} suffix="+" />
                </div>
                <div className="text-muted-foreground uppercase tracking-widest text-xs font-bold">Clients Served</div>
              </div>
              <div>
                <div className="text-4xl md:text-5xl font-extrabold text-secondary mb-2 font-mono">
                  <Counter value={stats.averageRoiIncrease} prefix="+" suffix="%" />
                </div>
                <div className="text-muted-foreground uppercase tracking-widest text-xs font-bold">Avg ROI</div>
              </div>
              <div>
                <div className="text-4xl md:text-5xl font-extrabold text-secondary mb-2 font-mono">
                  <Counter value={stats.countriesReached} suffix="+" />
                </div>
                <div className="text-muted-foreground uppercase tracking-widest text-xs font-bold">Countries</div>
              </div>
            </div>
          ) : null}
        </div>
      </section>
      
      {/* Story */}
      <section className="py-32 bg-background bg-dot-pattern">
        <div className="container mx-auto px-4 max-w-4xl text-center">
          <div className="section-label">Our Story</div>
          <h3 className="text-4xl md:text-5xl font-bold text-foreground mb-8">From Dubai to the World</h3>
          <div className="prose prose-lg mx-auto text-muted-foreground">
            <p>
              We started with a simple observation: agencies were getting too comfortable selling vanity metrics. Impressions, clicks, rankings — numbers that looked great on a dashboard but meant nothing for the bottom line.
            </p>
            <p>
              SEO.ae was built to change that. We assembled a team of technical SEOs, data scientists, and growth hackers who care about one thing: revenue. By treating search engines as programmable growth engines, we've helped startups become unicorns and enterprises dominate global markets.
            </p>
          </div>
        </div>
      </section>

      {/* Dark CTA Section */}
      <section className="py-32 hero-dark bg-grid-pattern-dark relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 text-center">
          <h2 className="text-4xl md:text-6xl font-extrabold text-white mb-6">Work With The Best</h2>
          <p className="text-xl text-white/80 max-w-2xl mx-auto mb-10">
            Join the ranks of market leaders who trust SEO.ae to drive their digital growth.
          </p>
          <div className="flex flex-col sm:flex-row justify-center gap-4">
            <Link href="/contact">
              <Button size="lg" className="h-14 px-10 text-lg w-full sm:w-auto">
                Get Your Free Audit
              </Button>
            </Link>
            <Link href="/careers">
              <Button size="lg" variant="inverted" className="h-14 px-10 text-lg w-full sm:w-auto">
                Join Our Team
              </Button>
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
}