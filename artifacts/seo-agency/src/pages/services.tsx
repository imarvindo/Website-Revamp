import { useListServices } from "@workspace/api-client-react";
import { Link } from "wouter";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { ArrowRight, BarChart, Cloud, Code, MapPin, PenTool, Rocket, Search, Server, Shield, ShoppingBag, Smartphone, TrendingUp } from "lucide-react";
import { Button } from "@/components/ui/button";
import { motion } from "framer-motion";

const ICON_MAP: Record<string, React.ElementType> = {
  "TrendingUp": TrendingUp,
  "Search": Search,
  "BarChart": BarChart,
  "Smartphone": Smartphone,
  "PenTool": PenTool,
  "Code": Code,
  "ShoppingBag": ShoppingBag,
  "Server": Server,
  "Cloud": Cloud,
  "Shield": Shield,
  "MapPin": MapPin,
  "Rocket": Rocket,
  "Target": BarChart,
  "Share2": TrendingUp,
  "Palette": PenTool,
  "Cpu": Search,
};

export default function Services() {
  const { data: services, isLoading } = useListServices();

  return (
    <div className="flex flex-col min-h-screen bg-background">
      {/* Dark Hero Section */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 text-center max-w-4xl">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
          >
            <div className="section-label text-white bg-white/10 border-white/20 mb-6">Our Capabilities</div>
            <h1 className="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
              Services Built for <span className="gradient-text-primary">Scale</span>
            </h1>
            <p className="text-xl text-white/70 mb-10 leading-relaxed font-light">
              We don't do cookie-cutter. Every strategy is engineered specifically for your market, your competitors, and your revenue goals.
            </p>
          </motion.div>
        </div>
      </section>

      {/* Services Grid (Light Theme) */}
      <section className="py-32 bg-dot-pattern">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {[1, 2, 3, 4, 5, 6].map(i => (
                <Skeleton key={i} className="h-[300px] rounded-2xl bg-muted" />
              ))}
            </div>
          ) : services ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {services.map((service, i) => {
                const Icon = ICON_MAP[service.icon] || TrendingUp;
                return (
                  <motion.div
                    key={service.id}
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ delay: i * 0.1 }}
                  >
                    <Link href={`/services/${service.slug}`}>
                      <div className="card-lift h-full group p-8 relative overflow-hidden flex flex-col">
                        <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity" />
                        
                        <div className="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center mb-8 group-hover:scale-110 transition-transform border border-primary/20">
                          <Icon className="w-8 h-8 text-primary" />
                        </div>
                        
                        <h3 className="text-2xl font-bold text-foreground mb-4 group-hover:text-primary transition-colors">{service.title}</h3>
                        
                        <p className="text-muted-foreground mb-8 flex-1 leading-relaxed text-base">{service.shortDescription}</p>
                        
                        <div className="flex items-center text-primary font-bold text-sm gap-2 mt-auto">
                          View Details <ArrowRight className="w-4 h-4 group-hover:translate-x-2 transition-transform" />
                        </div>
                      </div>
                    </Link>
                  </motion.div>
                );
              })}
            </div>
          ) : (
            <div className="text-center py-20 text-muted-foreground">No services found.</div>
          )}
        </div>
      </section>

      {/* Dark CTA Section */}
      <section className="py-32 hero-dark bg-grid-pattern-dark relative overflow-hidden">
        <div className="container mx-auto px-4 text-center max-w-3xl relative z-10">
          <h2 className="text-4xl md:text-5xl font-extrabold text-white mb-6">Not sure what you need?</h2>
          <p className="text-xl text-white/80 mb-10 font-light">Let our experts analyze your digital presence and provide a custom growth roadmap.</p>
          <Link href="/contact">
            <Button size="lg" className="h-14 px-10 text-lg">Get Free Audit</Button>
          </Link>
        </div>
      </section>
    </div>
  );
}