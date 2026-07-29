import { useGetService } from "@workspace/api-client-react";
import { Skeleton } from "@/components/ui/skeleton";
import { Button } from "@/components/ui/button";
import { Card } from "@/components/ui/card";
import { Link } from "wouter";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";
import { CheckCircle2, ChevronRight, TrendingUp, BarChart, Target, Zap } from "lucide-react";

export default function SEO() {
  const { data: service, isLoading } = useGetService("seo");

  if (isLoading) {
    return (
      <div className="pt-32 pb-20 container mx-auto px-4">
        <Skeleton className="h-20 w-3/4 mb-6" />
        <Skeleton className="h-6 w-1/2 mb-12" />
        <Skeleton className="h-[400px] w-full rounded-2xl mb-16" />
      </div>
    );
  }

  if (!service) {
    return (
      <div className="pt-32 pb-20 container mx-auto px-4 text-center">
        <h1 className="text-3xl font-bold text-white mb-4">Service not found</h1>
        <Link href="/services"><Button>Back to Services</Button></Link>
      </div>
    );
  }

  return (
    <div className="flex flex-col min-h-screen">
      {/* Hero Section */}
      <section className="pt-40 pb-20 relative overflow-hidden">
        <div className="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-primary/50 to-transparent" />
        <div className="absolute top-20 right-0 w-[500px] h-[500px] bg-primary/10 rounded-full blur-[100px] pointer-events-none" />
        
        <div className="container mx-auto px-4 relative z-10 grid lg:grid-cols-2 gap-12 items-center">
          <div>
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent/10 border border-accent/20 text-accent text-sm font-medium mb-6 uppercase tracking-wider">
              {service.category}
            </div>
            <h1 className="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-[1.1] mb-6 tracking-tight">
              {service.title}
            </h1>
            <p className="text-xl text-white/70 mb-10 leading-relaxed max-w-xl">
              {service.shortDescription}
            </p>
            <div className="flex flex-col sm:flex-row gap-4">
              <Link href="/contact">
                <Button size="lg" className="w-full sm:w-auto h-14 px-8 text-base">
                  Start Your Campaign
                </Button>
              </Link>
            </div>
          </div>
          <div className="relative">
            <img 
              src="/attached_assets/generated_images/seo-visualization.jpg" 
              alt="SEO Data Visualization" 
              className="w-full rounded-2xl shadow-2xl border border-white/10"
              onError={(e) => e.currentTarget.style.display = 'none'}
            />
            <div className="absolute -bottom-6 -left-6 bg-card border border-white/10 p-6 rounded-xl shadow-2xl flex items-center gap-4 animate-float">
              <div className="w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center">
                <TrendingUp className="w-6 h-6 text-green-500" />
              </div>
              <div>
                <div className="text-2xl font-bold text-white">+342%</div>
                <div className="text-xs text-white/60 uppercase">Avg Traffic Increase</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Description & Benefits */}
      <section className="py-24 bg-white/[0.02] border-y border-white/5">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-16">
            <div>
              <h2 className="text-3xl font-bold text-white mb-6">Why Enterprise SEO Matters</h2>
              <div className="prose prose-invert prose-lg text-white/70 max-w-none">
                <p>{service.fullDescription}</p>
              </div>
            </div>
            <div>
              <Card className="p-8 bg-black/20 border-white/10">
                <h3 className="text-2xl font-bold text-white mb-8">What You Get</h3>
                <ul className="space-y-4">
                  {service.benefits.map((benefit, i) => (
                    <li key={i} className="flex items-start gap-4">
                      <CheckCircle2 className="w-6 h-6 text-primary shrink-0 mt-0.5" />
                      <span className="text-white/80">{benefit}</span>
                    </li>
                  ))}
                </ul>
              </Card>
            </div>
          </div>
        </div>
      </section>

      {/* Process */}
      <section className="py-32">
        <div className="container mx-auto px-4 text-center max-w-4xl">
          <h2 className="text-sm font-bold text-accent tracking-widest uppercase mb-4">Our Methodology</h2>
          <h3 className="text-4xl md:text-5xl font-bold text-white mb-16">How We Rank You #1</h3>
          
          <div className="grid gap-8 text-left">
            {service.process.map((step, i) => (
              <Card key={i} className="p-8 flex flex-col md:flex-row gap-6 items-start border-white/10 hover:bg-white/5 transition-colors">
                <div className="w-16 h-16 shrink-0 rounded-2xl bg-primary/10 flex items-center justify-center text-primary text-2xl font-black border border-primary/20">
                  {step.step}
                </div>
                <div>
                  <h4 className="text-2xl font-bold text-white mb-3">{step.title}</h4>
                  <p className="text-white/60 leading-relaxed">{step.description}</p>
                </div>
              </Card>
            ))}
          </div>
        </div>
      </section>

      {/* FAQs */}
      {service.faqs && service.faqs.length > 0 && (
        <section className="py-24 bg-secondary/30 border-t border-white/5">
          <div className="container mx-auto px-4 max-w-3xl">
            <h2 className="text-3xl md:text-4xl font-bold text-center text-white mb-12">Frequently Asked Questions</h2>
            <Accordion type="single" collapsible className="w-full">
              {service.faqs.map((faq, i) => (
                <AccordionItem key={i} value={`item-${i}`} className="border-white/10">
                  <AccordionTrigger className="text-left text-lg text-white hover:text-primary hover:no-underline">
                    {faq.question}
                  </AccordionTrigger>
                  <AccordionContent className="text-white/60 text-base leading-relaxed">
                    {faq.answer}
                  </AccordionContent>
                </AccordionItem>
              ))}
            </Accordion>
          </div>
        </section>
      )}

      {/* CTA */}
      <section className="py-24 relative overflow-hidden bg-primary">
        <div className="container mx-auto px-4 relative z-10 text-center">
          <h2 className="text-4xl md:text-5xl font-bold text-white mb-6">Stop Leaving Money on the Table</h2>
          <p className="text-xl text-white/90 max-w-2xl mx-auto mb-10">
            Let's analyze your current search visibility and uncover the exact roadmap to industry dominance.
          </p>
          <Link href="/contact">
            <Button size="lg" variant="gold" className="h-14 px-10 text-lg">
              Get Your SEO Audit
            </Button>
          </Link>
        </div>
      </section>
    </div>
  );
}