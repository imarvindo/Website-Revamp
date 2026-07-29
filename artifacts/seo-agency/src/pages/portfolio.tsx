import { useListPortfolioItems } from "@workspace/api-client-react";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { ExternalLink } from "lucide-react";
import { motion } from "framer-motion";
import { Button } from "@/components/ui/button";
import { Link } from "wouter";

export default function Portfolio() {
  const { data: items, isLoading } = useListPortfolioItems();

  return (
    <div className="flex flex-col min-h-screen bg-background">
      {/* Dark Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="container mx-auto px-4 text-center max-w-3xl relative z-10">
          <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }}>
            <div className="section-label bg-white/10 text-white border-white/20 mb-6">Portfolio</div>
            <h1 className="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
              Our <span className="gradient-text-primary">Work</span>
            </h1>
            <p className="text-xl text-white/80 mb-10 font-light leading-relaxed">
              Premium digital experiences engineered for maximum conversion. High-end design meets elite performance.
            </p>
          </motion.div>
        </div>
      </section>

      {/* Grid (Light Theme) */}
      <section className="py-24 bg-dot-pattern">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {[1, 2, 3, 4, 5, 6].map(i => <Skeleton key={i} className="h-80 rounded-2xl bg-muted" />)}
            </div>
          ) : items ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {items.map((item, i) => (
                <motion.div key={item.id} initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ delay: i * 0.1 }}>
                  <Card className="group overflow-hidden bg-white border-border shadow-sm hover:shadow-xl transition-all duration-300 rounded-2xl h-full flex flex-col">
                    <div className="aspect-[4/3] relative overflow-hidden bg-muted">
                      {item.imageUrl ? (
                        <img src={item.imageUrl} alt={item.title} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                      ) : (
                        <div className="w-full h-full flex items-center justify-center text-muted-foreground font-bold bg-muted/50">
                          {item.title}
                        </div>
                      )}
                      <div className="absolute inset-0 bg-secondary/10 opacity-0 group-hover:opacity-100 transition-opacity" />
                      {item.projectUrl && (
                        <a href={item.projectUrl} target="_blank" rel="noopener noreferrer" className="absolute top-4 right-4 w-12 h-12 bg-white/90 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-primary text-secondary hover:text-white shadow-lg">
                          <ExternalLink className="w-5 h-5" />
                        </a>
                      )}
                    </div>
                    <div className="p-8 flex flex-col flex-1">
                      <div className="text-xs font-bold text-accent uppercase tracking-wider mb-3">{item.category}</div>
                      <h3 className="text-2xl font-bold text-foreground mb-3 group-hover:text-primary transition-colors">{item.title}</h3>
                      <p className="text-base text-muted-foreground mb-6 line-clamp-2 flex-1">{item.description}</p>
                      <div className="flex flex-wrap gap-2 mt-auto">
                        {item.technologies.slice(0,3).map(tech => (
                          <span key={tech} className="text-xs px-3 py-1.5 bg-muted rounded-md text-muted-foreground font-medium">{tech}</span>
                        ))}
                      </div>
                    </div>
                  </Card>
                </motion.div>
              ))}
            </div>
          ) : (
            <div className="text-center text-muted-foreground py-20">No projects found.</div>
          )}
        </div>
      </section>

      {/* Dark CTA */}
      <section className="py-24 hero-dark bg-grid-pattern-dark text-center mt-auto">
        <div className="container mx-auto px-4 max-w-3xl">
          <h2 className="text-4xl font-bold text-white mb-6">Need a High-Performance Website?</h2>
          <Link href="/contact">
            <Button size="lg" className="h-14 px-10 text-lg">Start Your Project</Button>
          </Link>
        </div>
      </section>
    </div>
  );
}