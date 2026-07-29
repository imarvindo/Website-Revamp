import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Globe, Mail, MapPin, Phone, ArrowRight } from "lucide-react";
import { SiFacebook, SiX, SiInstagram } from "react-icons/si";
import { Linkedin } from "lucide-react";
import { useSubscribeNewsletter } from "@workspace/api-client-react";
import { useToast } from "@/hooks/use-toast";
import { useState } from "react";

export default function Footer() {
  const { toast } = useToast();
  const subscribe = useSubscribeNewsletter();
  const [email, setEmail] = useState("");

  const handleSubscribe = (e: React.FormEvent) => {
    e.preventDefault();
    if (!email) return;
    
    subscribe.mutate(
      { data: { email } },
      {
        onSuccess: () => {
          toast({ title: "Subscribed successfully!", description: "Welcome to our newsletter." });
          setEmail("");
        },
        onError: () => {
          toast({ variant: "destructive", title: "Subscription failed", description: "Please try again later." });
        }
      }
    );
  };

  return (
    <footer className="bg-card border-t border-white/5 pt-20 pb-10 relative overflow-hidden">
      {/* Decorative gradient */}
      <div className="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-primary/50 to-transparent" />
      <div className="absolute top-0 right-1/4 w-[300px] h-[300px] bg-primary/5 rounded-full blur-[120px] pointer-events-none" />

      <div className="container mx-auto px-4">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
          {/* Brand Col */}
          <div className="space-y-6">
            <Link href="/" className="flex items-center gap-2 group">
              <div className="w-8 h-8 rounded bg-primary/20 flex items-center justify-center">
                <Globe className="w-5 h-5 text-primary" />
              </div>
              <span className="text-2xl font-bold tracking-tight text-white">SEO<span className="text-accent">.ae</span></span>
            </Link>
            <p className="text-muted-foreground text-sm leading-relaxed max-w-xs">
              Dubai's premium digital growth partner. We turn clicks into clients using data-driven SEO, AI optimization, and high-performance campaigns.
            </p>
            <div className="flex gap-4">
              <a href="#" className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-primary hover:text-white transition-colors">
                <SiFacebook className="w-4 h-4" />
              </a>
              <a href="#" className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-primary hover:text-white transition-colors">
                <SiX className="w-4 h-4" />
              </a>
              <a href="#" className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-primary hover:text-white transition-colors">
                <Linkedin className="w-4 h-4" />
              </a>
              <a href="#" className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-primary hover:text-white transition-colors">
                <SiInstagram className="w-4 h-4" />
              </a>
            </div>
          </div>

          {/* Links Col 1 */}
          <div>
            <h4 className="font-semibold text-white mb-6">Services</h4>
            <ul className="space-y-3 text-sm text-muted-foreground">
              <li><Link href="/seo" className="hover:text-primary transition-colors">Enterprise SEO</Link></li>
              <li><Link href="/ai-search-optimization" className="hover:text-primary transition-colors">AI Search Optimization</Link></li>
              <li><Link href="/ppc" className="hover:text-primary transition-colors">PPC & Google Ads</Link></li>
              <li><Link href="/social-media-marketing" className="hover:text-primary transition-colors">Social Media Marketing</Link></li>
              <li><Link href="/web-design" className="hover:text-primary transition-colors">Premium Web Design</Link></li>
              <li><Link href="/web-development" className="hover:text-primary transition-colors">Web Development</Link></li>
            </ul>
          </div>

          {/* Links Col 2 */}
          <div>
            <h4 className="font-semibold text-white mb-6">Company</h4>
            <ul className="space-y-3 text-sm text-muted-foreground">
              <li><Link href="/about" className="hover:text-primary transition-colors">About Us</Link></li>
              <li><Link href="/case-studies" className="hover:text-primary transition-colors">Case Studies</Link></li>
              <li><Link href="/portfolio" className="hover:text-primary transition-colors">Portfolio</Link></li>
              <li><Link href="/blog" className="hover:text-primary transition-colors">Insights & Blog</Link></li>
              <li><Link href="/careers" className="hover:text-primary transition-colors">Careers</Link></li>
              <li><Link href="/contact" className="hover:text-primary transition-colors">Contact Us</Link></li>
            </ul>
          </div>

          {/* Contact Col */}
          <div>
            <h4 className="font-semibold text-white mb-6">Connect</h4>
            <ul className="space-y-4 text-sm text-muted-foreground mb-8">
              <li className="flex items-start gap-3">
                <MapPin className="w-5 h-5 text-primary shrink-0" />
                <span>Level 42, Emirates Towers<br/>Sheikh Zayed Road, Dubai, UAE</span>
              </li>
              <li className="flex items-center gap-3">
                <Phone className="w-5 h-5 text-primary shrink-0" />
                <span>+971 4 123 4567</span>
              </li>
              <li className="flex items-center gap-3">
                <Mail className="w-5 h-5 text-primary shrink-0" />
                <span>growth@seo.ae</span>
              </li>
            </ul>
            
            <form onSubmit={handleSubscribe} className="space-y-3">
              <span className="text-sm font-semibold text-white">Subscribe to insights</span>
              <div className="flex gap-2">
                <Input 
                  type="email" 
                  placeholder="Your email address" 
                  className="bg-background border-white/10"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  disabled={subscribe.isPending}
                />
                <Button type="submit" size="icon" disabled={subscribe.isPending}>
                  <ArrowRight className="w-4 h-4" />
                </Button>
              </div>
            </form>
          </div>
        </div>

        <div className="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-muted-foreground">
          <p>&copy; {new Date().getFullYear()} SEO.ae. All rights reserved.</p>
          <div className="flex items-center gap-6">
            <Link href="/privacy" className="hover:text-white transition-colors">Privacy Policy</Link>
            <Link href="/terms" className="hover:text-white transition-colors">Terms of Service</Link>
            <Link href="/sitemap" className="hover:text-white transition-colors">Sitemap</Link>
          </div>
        </div>
      </div>
    </footer>
  );
}