import { useGetService } from "@workspace/api-client-react";
import { Skeleton } from "@/components/ui/skeleton";
import { Button } from "@/components/ui/button";
import { Card } from "@/components/ui/card";
import { Link } from "wouter";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";
import { CheckCircle2, TrendingUp, ArrowRight, Phone } from "lucide-react";
import { motion } from "framer-motion";

export function ServiceLayout({ slug, imagePath }: { slug: string; imagePath?: string }) {
  const { data: service, isLoading } = useGetService(slug);

  if (isLoading) {
    return (
      <div className="pt-40 pb-20 container mx-auto px-4">
        <Skeleton className="h-6 w-32 mb-4" />
        <Skeleton className="h-16 w-3/4 mb-6" />
        <Skeleton className="h-6 w-1/2 mb-12" />
        <Skeleton className="h-[400px] w-full rounded-2xl" />
      </div>
    );
  }

  if (!service) {
    return (
      <div className="pt-40 pb-20 container mx-auto px-4 text-center">
        <h1 className="text-3xl font-bold text-foreground mb-4">Service not found</h1>
        <Link href="/services"><Button>Back to Services</Button></Link>
      </div>
    );
  }

  return (
    <div className="flex flex-col">
      {/* ── Hero ──────────────────────────────────────────── */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-primary/60 to-transparent" />

        <div className="container mx-auto px-4 relative z-10">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <motion.div
              initial={{ opacity: 0, y: 24 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
            >
              <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/15 border border-primary/30 text-primary text-xs font-bold uppercase tracking-widest mb-6">
                {service.category}
              </div>
              <h1 className="text-5xl md:text-6xl font-extrabold text-white leading-[1.1] mb-6 tracking-tight">
                {service.title}
              </h1>
              <p className="text-xl text-white/70 mb-10 leading-relaxed max-w-xl">
                {service.shortDescription}
              </p>
              <div className="flex flex-col sm:flex-row gap-4">
                <Link href="/contact">
                  <Button size="lg" variant="default" className="h-13 px-8 text-base gap-2">
                    Start Your Campaign <ArrowRight className="w-5 h-5" />
                  </Button>
                </Link>
                <a href="tel:+97141234567">
                  <Button size="lg" variant="inverted" className="h-13 px-8 text-base gap-2">
                    <Phone className="w-4 h-4" /> Call Us Now
                  </Button>
                </a>
              </div>
            </motion.div>

            {imagePath ? (
              <motion.div
                initial={{ opacity: 0, x: 24 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.6, delay: 0.2 }}
                className="relative hidden lg:block"
              >
                <img
                  src={imagePath}
                  alt={service.title}
                  className="w-full rounded-2xl shadow-2xl ring-1 ring-white/10"
                  onError={(e) => (e.currentTarget.style.display = "none")}
                />
                {/* Floating stat card */}
                <div className="absolute -bottom-6 -left-6 bg-white text-foreground p-5 rounded-xl shadow-2xl flex items-center gap-4 animate-float">
                  <div className="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center">
                    <TrendingUp className="w-5 h-5 text-primary" />
                  </div>
                  <div>
                    <div className="text-2xl font-bold text-secondary">Premium</div>
                    <div className="text-xs text-muted-foreground uppercase tracking-wider">Results Driven</div>
                  </div>
                </div>
              </motion.div>
            ) : (
              // Decorative stat grid if no image
              <div className="hidden lg:grid grid-cols-2 gap-4">
                {[
                  { value: "340%", label: "Avg. ROI Increase" },
                  { value: "1,200+", label: "Projects Delivered" },
                  { value: "4.9/5", label: "Client Rating" },
                  { value: "10+", label: "Years Experience" },
                ].map(({ value, label }) => (
                  <div key={label} className="glass-panel-dark p-6 rounded-2xl text-center">
                    <div className="text-3xl font-extrabold text-primary mb-1">{value}</div>
                    <div className="text-xs text-white/60 uppercase tracking-wider">{label}</div>
                  </div>
                ))}
              </div>
            )}
          </div>
        </div>
      </section>

      {/* ── Description & Benefits ───────────────────────── */}
      <section className="py-24 bg-background">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-16 items-start">
            <div>
              <h2 className="text-3xl font-bold text-foreground mb-6">Why It Matters</h2>
              <div className="prose prose-lg text-muted-foreground max-w-none">
                <p>{service.fullDescription}</p>
              </div>
            </div>
            <Card className="p-8 border-border shadow-sm">
              <h3 className="text-xl font-bold text-foreground mb-6 flex items-center gap-2">
                <span className="w-7 h-7 rounded-full bg-primary/10 flex items-center justify-center">
                  <CheckCircle2 className="w-4 h-4 text-primary" />
                </span>
                What You Get
              </h3>
              <ul className="space-y-4">
                {service.benefits.map((benefit, i) => (
                  <li key={i} className="flex items-start gap-3">
                    <CheckCircle2 className="w-5 h-5 text-primary shrink-0 mt-0.5" />
                    <span className="text-foreground/80 text-sm leading-relaxed">{benefit}</span>
                  </li>
                ))}
              </ul>
            </Card>
          </div>
        </div>
      </section>

      {/* ── Process ──────────────────────────────────────── */}
      <section className="py-24 bg-muted/30">
        <div className="container mx-auto px-4 max-w-4xl">
          <div className="text-center mb-14">
            <div className="section-label mb-4">Our Methodology</div>
            <h2 className="text-4xl font-bold text-foreground">How We Deliver Results</h2>
          </div>

          <div className="grid gap-6 relative">
            {/* Connecting line */}
            <div className="absolute left-8 top-16 bottom-16 w-px bg-gradient-to-b from-primary/30 via-primary/20 to-transparent hidden md:block" />

            {service.process.map((step, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, x: -16 }}
                whileInView={{ opacity: 1, x: 0 }}
                viewport={{ once: true }}
                transition={{ delay: i * 0.1 }}
                className="bg-white border border-border rounded-2xl p-7 flex flex-col md:flex-row gap-6 items-start shadow-sm hover:shadow-md transition-shadow"
              >
                <div className="w-14 h-14 shrink-0 rounded-2xl bg-primary/10 flex items-center justify-center text-primary text-xl font-black border border-primary/20">
                  {step.step}
                </div>
                <div>
                  <h4 className="text-xl font-bold text-foreground mb-2">{step.title}</h4>
                  <p className="text-muted-foreground leading-relaxed">{step.description}</p>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* ── FAQs ─────────────────────────────────────────── */}
      {service.faqs && service.faqs.length > 0 && (
        <section className="py-24 bg-background">
          <div className="container mx-auto px-4 max-w-3xl">
            <div className="text-center mb-12">
              <div className="section-label mb-4">FAQ</div>
              <h2 className="text-3xl md:text-4xl font-bold text-foreground">
                Frequently Asked Questions
              </h2>
            </div>
            <Accordion type="single" collapsible className="w-full space-y-3">
              {service.faqs.map((faq, i) => (
                <AccordionItem
                  key={i}
                  value={`item-${i}`}
                  className="border border-border rounded-xl px-2 shadow-sm bg-white"
                >
                  <AccordionTrigger className="text-left text-base font-semibold text-foreground hover:text-primary hover:no-underline px-4 py-4">
                    {faq.question}
                  </AccordionTrigger>
                  <AccordionContent className="text-muted-foreground text-sm leading-relaxed px-4 pb-4">
                    {faq.answer}
                  </AccordionContent>
                </AccordionItem>
              ))}
            </Accordion>
          </div>
        </section>
      )}

      {/* ── CTA ──────────────────────────────────────────── */}
      <section className="py-24 hero-dark relative overflow-hidden">
        <div className="absolute inset-0 bg-grid-pattern-dark opacity-40" />
        <div className="container mx-auto px-4 relative z-10 text-center max-w-3xl">
          <h2 className="text-4xl md:text-5xl font-bold text-white mb-5">
            Ready to Scale with {service.title}?
          </h2>
          <p className="text-xl text-white/70 mb-10">
            Let's build a custom strategy that drives measurable growth for your business.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link href="/contact">
              <Button size="lg" variant="default" className="h-14 px-10 text-base gap-2">
                Get Free Consultation <ArrowRight className="w-5 h-5" />
              </Button>
            </Link>
            <a href="tel:+97141234567">
              <Button size="lg" variant="inverted" className="h-14 px-10 text-base gap-2">
                <Phone className="w-5 h-5" /> +971 4 123 4567
              </Button>
            </a>
          </div>
        </div>
      </section>
    </div>
  );
}
