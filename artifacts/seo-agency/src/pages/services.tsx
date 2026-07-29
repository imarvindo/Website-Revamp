import { useListServices } from "@workspace/api-client-react";
import { Link } from "wouter";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { ArrowRight, BarChart, Code, PenTool, Search, Smartphone, TrendingUp } from "lucide-react";
import { Button } from "@/components/ui/button";

const ICON_MAP: Record<string, React.ElementType> = {
  "TrendingUp": TrendingUp,
  "Search": Search,
  "BarChart": BarChart,
  "Smartphone": Smartphone,
  "PenTool": PenTool,
  "Code": Code
};

export default function Services() {
  const { data: services, isLoading } = useListServices();

  return (
    <div className="flex flex-col min-h-screen">
      {/* Hero Section */}
      <section className="pt-40 pb-20 relative overflow-hidden bg-secondary/30">
        <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px]" />
        
        <div className="container mx-auto px-4 relative z-10 text-center max-w-4xl">
          <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6">
            Services Built for <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-400">Scale</span>
          </h1>
          <p className="text-xl text-white/70 mb-10 leading-relaxed">
            We don't do cookie-cutter. Every strategy is engineered specifically for your market, your competitors, and your revenue goals.
          </p>
        </div>
      </section>

      {/* Services Grid */}
      <section className="py-24">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {[1, 2, 3, 4, 5, 6].map(i => (
                <Skeleton key={i} className="h-80 rounded-2xl" />
              ))}
            </div>
          ) : services ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {services.map((service) => {
                const Icon = ICON_MAP[service.icon] || TrendingUp;
                return (
                  <Link key={service.id} href={`/${service.slug}`}>
                    <Card className="group h-full hover:bg-white/5 transition-all duration-300 border-white/10 hover:border-primary/50 relative overflow-hidden flex flex-col">
                      <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity" />
                      <div className="p-8 flex flex-col flex-1">
                        <div className="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center mb-8 group-hover:scale-110 transition-transform border border-primary/20">
                          <Icon className="w-8 h-8 text-primary" />
                        </div>
                        <h3 className="text-2xl font-bold text-white mb-4 group-hover:text-primary transition-colors">{service.title}</h3>
                        <p className="text-white/60 mb-8 flex-1 leading-relaxed">{service.shortDescription}</p>
                        <div className="flex items-center text-primary font-medium gap-2 mt-auto">
                          View Details <ArrowRight className="w-4 h-4 group-hover:translate-x-2 transition-transform" />
                        </div>
                      </div>
                    </Card>
                  </Link>
                );
              })}
            </div>
          ) : (
            <div className="text-center py-20 text-white/50">No services found.</div>
          )}
        </div>
      </section>

      {/* CTA */}
      <section className="py-24 bg-card border-t border-white/5 text-center">
        <div className="container mx-auto px-4 max-w-3xl">
          <h2 className="text-3xl font-bold text-white mb-6">Not sure what you need?</h2>
          <p className="text-white/60 mb-8 text-lg">Let our experts analyze your digital presence and provide a custom growth roadmap.</p>
          <Link href="/contact">
            <Button size="lg" variant="gold" className="h-14 px-10">Get Free Audit</Button>
          </Link>
        </div>
      </section>
    </div>
  );
}