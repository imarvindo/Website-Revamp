import { useListPortfolioItems } from "@workspace/api-client-react";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { ExternalLink } from "lucide-react";

export default function Portfolio() {
  const { data: items, isLoading } = useListPortfolioItems();

  return (
    <div className="flex flex-col min-h-screen">
      <section className="pt-40 pb-20 relative overflow-hidden bg-secondary/30">
        <div className="container mx-auto px-4 text-center max-w-3xl relative z-10">
          <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6">
            Our <span className="text-primary">Work</span>
          </h1>
          <p className="text-xl text-white/70 mb-10">
            Premium digital experiences engineered for maximum conversion.
          </p>
        </div>
      </section>

      <section className="py-24">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {[1, 2, 3, 4, 5, 6].map(i => <Skeleton key={i} className="h-80 rounded-2xl" />)}
            </div>
          ) : items ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {items.map((item) => (
                <Card key={item.id} className="group overflow-hidden border-white/10 hover:border-primary/50 transition-colors">
                  <div className="aspect-[4/3] relative overflow-hidden bg-white/5">
                    {item.imageUrl ? (
                      <img src={item.imageUrl} alt={item.title} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    ) : (
                      <div className="w-full h-full flex items-center justify-center text-white/20 font-bold bg-gradient-to-br from-secondary to-background">
                        {item.title}
                      </div>
                    )}
                    {item.projectUrl && (
                      <a href={item.projectUrl} target="_blank" rel="noopener noreferrer" className="absolute top-4 right-4 w-10 h-10 bg-black/50 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-primary text-white">
                        <ExternalLink className="w-5 h-5" />
                      </a>
                    )}
                  </div>
                  <div className="p-6">
                    <div className="text-xs font-bold text-accent uppercase tracking-wider mb-2">{item.category}</div>
                    <h3 className="text-xl font-bold text-white mb-2">{item.title}</h3>
                    <p className="text-sm text-white/60 mb-4 line-clamp-2">{item.description}</p>
                    <div className="flex flex-wrap gap-2">
                      {item.technologies.slice(0,3).map(tech => (
                        <span key={tech} className="text-xs px-2 py-1 bg-white/5 rounded text-white/70">{tech}</span>
                      ))}
                    </div>
                  </div>
                </Card>
              ))}
            </div>
          ) : (
            <div className="text-center text-white/50">No projects found.</div>
          )}
        </div>
      </section>
    </div>
  );
}