import { useListCaseStudies } from "@workspace/api-client-react";
import { Link } from "wouter";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { Button } from "@/components/ui/button";

export default function CaseStudies() {
  const { data: caseStudies, isLoading } = useListCaseStudies();

  return (
    <div className="flex flex-col min-h-screen">
      <section className="pt-40 pb-20 relative overflow-hidden bg-secondary/30">
        <div className="container mx-auto px-4 text-center max-w-3xl relative z-10">
          <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6">
            Proven <span className="text-primary">Results</span>
          </h1>
          <p className="text-xl text-white/70 mb-10">
            Real data. Real growth. See how we've helped ambitious brands dominate their markets.
          </p>
        </div>
      </section>

      <section className="py-24">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid md:grid-cols-2 gap-8">
              {[1, 2, 3, 4].map(i => <Skeleton key={i} className="h-[400px] rounded-2xl" />)}
            </div>
          ) : caseStudies ? (
            <div className="grid md:grid-cols-2 gap-8">
              {caseStudies.map((cs) => (
                <Link key={cs.id} href={`/case-studies/${cs.slug}`}>
                  <Card className="group overflow-hidden border-white/10 hover:border-primary/50 transition-colors h-full flex flex-col">
                    <div className="aspect-video relative overflow-hidden bg-white/5">
                      {cs.featuredImage ? (
                        <img src={cs.featuredImage} alt={cs.clientName} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                      ) : (
                        <div className="w-full h-full flex items-center justify-center text-white/20 font-bold text-3xl bg-gradient-to-br from-secondary to-background">
                          {cs.clientName}
                        </div>
                      )}
                      <div className="absolute inset-0 bg-gradient-to-t from-background via-background/20 to-transparent opacity-80" />
                      <div className="absolute bottom-6 left-6">
                        <div className="px-3 py-1 bg-primary/20 backdrop-blur-md text-primary text-xs font-bold rounded-full mb-3 inline-block uppercase tracking-wider">
                          {cs.service}
                        </div>
                        <h4 className="text-3xl font-bold text-white">{cs.clientName}</h4>
                      </div>
                    </div>
                    <div className="p-8 flex-1 flex flex-col justify-between">
                      <p className="text-white/70 mb-8 text-lg">{cs.challenge}</p>
                      <div className="grid grid-cols-2 gap-6 bg-white/5 p-6 rounded-xl">
                        {cs.results.slice(0, 2).map((r, i) => (
                          <div key={i}>
                            <div className="text-3xl font-bold text-primary mb-1">{r.value}</div>
                            <div className="text-xs text-white/50 uppercase tracking-wider">{r.label}</div>
                          </div>
                        ))}
                      </div>
                    </div>
                  </Card>
                </Link>
              ))}
            </div>
          ) : (
            <div className="text-center text-white/50">No case studies found.</div>
          )}
        </div>
      </section>

      <section className="py-24 bg-card border-t border-white/5 text-center">
        <div className="container mx-auto px-4">
          <h2 className="text-3xl font-bold text-white mb-6">Want these results for your business?</h2>
          <Link href="/contact">
            <Button size="lg" className="h-14 px-10">Get a Custom Proposal</Button>
          </Link>
        </div>
      </section>
    </div>
  );
}