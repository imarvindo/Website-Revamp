import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { MapPin, Phone, Mail } from "lucide-react";

export default function LocationDubai() {
  return (
    <div className="flex flex-col min-h-screen bg-background">
      {/* Dark Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-32 relative overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img 
            src="/attached_assets/generated_images/dubai-hero.jpg" 
            alt="Dubai Skyline" 
            className="w-full h-full object-cover opacity-20 object-center mix-blend-overlay"
            onError={(e) => e.currentTarget.style.display = 'none'}
          />
          <div className="absolute inset-0 bg-gradient-to-t from-secondary/90 to-transparent" />
        </div>
        
        <div className="container mx-auto px-4 relative z-10 max-w-4xl text-center">
          <div className="section-label bg-white/10 text-white border-white/20 mb-6">Headquarters</div>
          <h1 className="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
            SEO Agency <span className="gradient-text-primary">Dubai</span>
          </h1>
          <p className="text-xl text-white/80 mb-10 leading-relaxed font-light">
            Our global headquarters. Driving digital dominance for the Middle East's most ambitious brands.
          </p>
        </div>
      </section>

      {/* Main Content (Light Theme) */}
      <section className="py-24 relative z-20 -mt-20">
        <div className="container mx-auto px-4 max-w-5xl">
          <div className="grid md:grid-cols-3 gap-6 text-left">
            <div className="bg-white border border-border p-8 rounded-3xl shadow-lg hover:-translate-y-1 transition-transform duration-300">
              <div className="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center mb-6 border border-primary/20">
                <MapPin className="w-7 h-7 text-primary" />
              </div>
              <h3 className="text-xl font-bold text-foreground mb-3">Address</h3>
              <p className="text-muted-foreground text-base leading-relaxed">M-01, Muteena Street<br/>Above Saravana Bhavan<br/>Deira, Dubai, UAE</p>
            </div>
            <div className="bg-white border border-border p-8 rounded-3xl shadow-lg hover:-translate-y-1 transition-transform duration-300">
              <div className="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center mb-6 border border-primary/20">
                <Mail className="w-7 h-7 text-primary" />
              </div>
              <h3 className="text-xl font-bold text-foreground mb-3">Email</h3>
              <p className="text-muted-foreground text-base leading-relaxed">
                <a href="mailto:sales@searchengineoptimization.ae" className="hover:text-primary transition-colors">sales@searchengineoptimization.ae</a>
                <br/>Mon-Fri, 9am-6pm GST
              </p>
            </div>
          </div>
        </div>
      </section>

      <section className="py-24 bg-muted/30 border-y border-border">
        <div className="container mx-auto px-4 max-w-4xl text-center">
          <h2 className="text-4xl font-bold text-foreground mb-6">Visit Our Office</h2>
          <p className="text-lg text-muted-foreground mb-12">
            Located in the heart of Dubai's business district, our headquarters is where strategy meets execution. Stop by for a coffee and a growth consultation.
          </p>
          <Link href="/contact">
            <Button size="lg" className="px-10 h-14 text-lg">Book a Consultation</Button>
          </Link>
        </div>
      </section>

      {/* Dark CTA */}
      <section className="py-24 hero-dark bg-grid-pattern-dark text-center mt-auto">
        <div className="container mx-auto px-4 max-w-3xl">
          <h2 className="text-4xl font-bold text-white mb-6">Ready to conquer the MENA market?</h2>
          <Link href="/contact">
            <Button variant="inverted" size="lg" className="h-14 px-10 text-lg">Get Free Audit</Button>
          </Link>
        </div>
      </section>
    </div>
  );
}