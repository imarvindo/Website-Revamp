import { useListCaseStudies } from "@workspace/api-client-react";
import { Link } from "wouter";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { Button } from "@/components/ui/button";
import { motion } from "framer-motion";
import { ArrowRight } from "lucide-react";

export default function CaseStudies() {
  const { data: caseStudies, isLoading } = useListCaseStudies();

  return (
    <div className="flex flex-col min-h-screen bg-background">
      {/* Dark Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="container mx-auto px-4 text-center max-w-3xl relative z-10">
          <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }}>
            <div className="section-label bg-white/10 text-white border-white/20 mb-6">Case Studies</div>
            <h1 className="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
              Proven <span className="gradient-text-primary">Results</span>
            </h1>
            <p className="text-xl text-white/80 mb-10 font-light leading-relaxed">
              Real data. Real growth. See how we've helped ambitious brands dominate their markets and scale revenue.
            </p>
          </motion.div>
        </div>
      </section>

      {/* Grid (Light Theme) */}
      <section className="py-24 bg-dot-pattern">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid md:grid-cols-2 gap-8">
              {[1, 2, 3, 4].map(i => <Skeleton key={i} className="h-[500px] rounded-3xl bg-muted" />)}
            </div>
          ) : caseStudies ? (
            <div className="grid md:grid-cols-2 gap-10">
              {caseStudies.map((cs, i) => (
                <motion.div key={cs.id} initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ delay: i * 0.1 }}>
                  <Link href={`/case-studies/${cs.slug}`}>
                    <Card className="group overflow-hidden bg-white border-border hover:border-primary/50 hover:shadow-xl transition-all duration-300 h-full flex flex-col rounded-3xl">
                      <div className="aspect-video relative overflow-hidden bg-muted">
                        {cs.featuredImage ? (
                          <img src={cs.featuredImage} alt={cs.clientName} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                        ) : (
                          <div className="w-full h-full flex items-center justify-center text-muted-foreground font-bold text-3xl bg-muted/50">
                            {cs.clientName}
                          </div>
                        )}
                        <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent" />
                        <div className="absolute bottom-6 left-8">
                          <div className="px-4 py-1.5 bg-primary text-white text-xs font-bold rounded-full mb-3 inline-block uppercase tracking-wider shadow-sm">
                            {cs.service}
                          </div>
                          <h4 className="text-3xl font-extrabold text-white">{cs.clientName}</h4>
                        </div>
                      </div>
                      <div className="p-8 flex-1 flex flex-col justify-between">
                        <p className="text-muted-foreground mb-8 text-lg font-medium line-clamp-3">{cs.challenge}</p>
                        <div className="grid grid-cols-2 gap-6 bg-muted/30 p-6 rounded-2xl border border-border">
                          {cs.results.slice(0, 2).map((r, idx) => (
                            <div key={idx}>
                              <div className="text-3xl font-black text-secondary mb-1">{r.value}</div>
                              <div className="text-xs font-bold text-muted-foreground uppercase tracking-wider">{r.label}</div>
                            </div>
                          ))}
                        </div>
                        <div className="mt-8 flex items-center text-primary font-bold text-sm gap-2">
                          Read Case Study <ArrowRight className="w-4 h-4 group-hover:translate-x-2 transition-transform" />
                        </div>
                      </div>
                    </Card>
                  </Link>
                </motion.div>
              ))}
            </div>
          ) : (
            <div className="text-center text-muted-foreground py-20">No case studies found.</div>
          )}
        </div>
      </section>

      {/* Dark CTA */}
      <section className="py-24 hero-dark bg-grid-pattern-dark text-center mt-auto">
        <div className="container mx-auto px-4 max-w-3xl">
          <h2 className="text-4xl font-bold text-white mb-6">Want these results for your business?</h2>
          <p className="text-lg text-white/80 mb-10 font-light">Let's build a custom growth strategy tailored to your market.</p>
          <Link href="/contact">
            <Button size="lg" className="h-14 px-10 text-lg">Get a Custom Proposal</Button>
          </Link>
        </div>
      </section>
    </div>
  );
}