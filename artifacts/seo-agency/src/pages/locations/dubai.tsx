import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { MapPin, Phone, Mail } from "lucide-react";

export default function LocationDubai() {
  return (
    <div className="flex flex-col min-h-screen">
      <section className="pt-40 pb-20 relative overflow-hidden bg-background">
        <div className="absolute inset-0 z-0">
          <img 
            src="/attached_assets/generated_images/dubai-hero.jpg" 
            alt="Dubai Skyline" 
            className="w-full h-full object-cover opacity-20 object-center"
            onError={(e) => e.currentTarget.style.display = 'none'}
          />
          <div className="absolute inset-0 bg-gradient-to-b from-background/40 via-background/80 to-background" />
        </div>
        
        <div className="container mx-auto px-4 relative z-10 max-w-4xl text-center">
          <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6">
            SEO Agency <span className="text-primary">Dubai</span>
          </h1>
          <p className="text-xl text-white/70 mb-10 leading-relaxed">
            Our global headquarters. Driving digital dominance for the Middle East's most ambitious brands.
          </p>
          
          <div className="grid md:grid-cols-3 gap-6 text-left mt-16">
            <div className="bg-card/80 backdrop-blur border border-white/10 p-6 rounded-2xl">
              <MapPin className="w-8 h-8 text-primary mb-4" />
              <h3 className="font-bold text-white mb-2">Address</h3>
              <p className="text-white/60 text-sm">Level 42, Emirates Towers<br/>Sheikh Zayed Road<br/>Dubai, UAE</p>
            </div>
            <div className="bg-card/80 backdrop-blur border border-white/10 p-6 rounded-2xl">
              <Phone className="w-8 h-8 text-primary mb-4" />
              <h3 className="font-bold text-white mb-2">Phone</h3>
              <p className="text-white/60 text-sm">+971 4 123 4567<br/>Mon-Fri, 9am-6pm GST</p>
            </div>
            <div className="bg-card/80 backdrop-blur border border-white/10 p-6 rounded-2xl">
              <Mail className="w-8 h-8 text-primary mb-4" />
              <h3 className="font-bold text-white mb-2">Email</h3>
              <p className="text-white/60 text-sm">dubai@seo.ae<br/>growth@seo.ae</p>
            </div>
          </div>
          
          <div className="mt-16">
            <Link href="/contact"><Button size="lg" variant="gold" className="px-10 h-14 text-lg">Book a Consultation</Button></Link>
          </div>
        </div>
      </section>
    </div>
  );
}