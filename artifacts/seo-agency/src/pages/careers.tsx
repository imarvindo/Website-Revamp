import { Link } from "wouter";
import { Button } from "@/components/ui/button";

export default function Careers() {
  return (
    <div className="flex flex-col min-h-screen bg-background">
      {/* Dark Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="container mx-auto px-4 text-center max-w-3xl relative z-10">
          <div className="section-label bg-white/10 text-white border-white/20 mb-6">Careers</div>
          <h1 className="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
            Join the <span className="gradient-text-primary">Elite</span>
          </h1>
          <p className="text-xl text-white/80 mb-10 leading-relaxed font-light">
            We're always looking for brilliant minds to join our Dubai headquarters. If you're obsessed with performance and growth, we want to talk.
          </p>
        </div>
      </section>

      {/* Main Content (Light) */}
      <section className="py-32">
        <div className="container mx-auto px-4 text-center max-w-2xl">
          <div className="bg-white border border-border rounded-3xl p-12 shadow-sm">
            <div className="w-20 h-20 rounded-full bg-muted flex items-center justify-center mx-auto mb-6">
              <svg className="w-10 h-10 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <h2 className="text-3xl font-bold text-foreground mb-4">No Open Positions</h2>
            <p className="text-lg text-muted-foreground mb-10">
              We don't have any specific roles open right now, but we are always on the lookout for top-tier talent in SEO, Web Design, and Paid Media.
            </p>
            <div className="space-y-4">
              <p className="font-semibold text-foreground">Think you have what it takes?</p>
              <Link href="/contact">
                <Button size="lg" className="w-full sm:w-auto h-14 px-8">Send General Application</Button>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Dark CTA Bottom */}
      <section className="py-24 hero-dark bg-grid-pattern-dark relative overflow-hidden mt-auto">
        <div className="container mx-auto px-4 text-center">
          <h2 className="text-3xl font-bold text-white mb-6">Explore Our Work</h2>
          <Link href="/portfolio">
            <Button variant="inverted" size="lg" className="h-14 px-10">View Portfolio</Button>
          </Link>
        </div>
      </section>
    </div>
  );
}