import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Globe, Mail, MapPin, Phone, ArrowRight, ExternalLink } from "lucide-react";
import { Linkedin } from "lucide-react";
import { SiFacebook, SiX, SiInstagram } from "react-icons/si";
import { useSubscribeNewsletter } from "@workspace/api-client-react";
import { useToast } from "@/hooks/use-toast";
import { useState } from "react";

const SERVICES = [
  { label: "Enterprise SEO", href: "/seo" },
  { label: "AI Search Optimization", href: "/ai-search-optimization" },
  { label: "PPC & Google Ads", href: "/ppc" },
  { label: "Social Media Marketing", href: "/social-media-marketing" },
  { label: "Premium Web Design", href: "/web-design" },
  { label: "Web Development", href: "/web-development" },
];

const COMPANY = [
  { label: "About Us", href: "/about" },
  { label: "Case Studies", href: "/case-studies" },
  { label: "Portfolio", href: "/portfolio" },
  { label: "Insights & Blog", href: "/blog" },
  { label: "FAQ", href: "/faq" },
  { label: "Careers", href: "/careers" },
  { label: "Contact Us", href: "/contact" },
];

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
          toast({ title: "Subscribed!", description: "You're now on our insider list." });
          setEmail("");
        },
        onError: () => {
          toast({ variant: "destructive", title: "Failed to subscribe", description: "Please try again." });
        },
      }
    );
  };

  return (
    <footer className="bg-secondary text-white relative overflow-hidden">
      {/* Top gradient glow */}
      <div className="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-primary/60 to-transparent" />
      <div className="absolute top-0 left-1/4 w-[400px] h-[400px] bg-primary/8 rounded-full blur-[120px] pointer-events-none" />

      {/* Main content */}
      <div className="container mx-auto px-4 pt-20 pb-12 relative z-10">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

          {/* Brand */}
          <div className="lg:col-span-1 space-y-6">
            <Link href="/" className="flex items-center gap-2.5 group">
              <div className="w-9 h-9 rounded-lg bg-primary flex items-center justify-center">
                <Globe className="w-5 h-5 text-white" />
              </div>
              <span className="text-2xl font-bold tracking-tight">
                SEO<span className="text-primary">.ae</span>
              </span>
            </Link>
            <p className="text-white/60 text-sm leading-relaxed max-w-xs">
              Dubai's premium digital growth partner. AI-driven SEO, high-converting design, and precision paid media that turns your business into a market leader.
            </p>
            {/* Social */}
            <div className="flex gap-3">
              {[
                { icon: <SiFacebook className="w-4 h-4" />, label: "Facebook" },
                { icon: <SiX className="w-4 h-4" />, label: "X" },
                { icon: <Linkedin className="w-4 h-4" />, label: "LinkedIn" },
                { icon: <SiInstagram className="w-4 h-4" />, label: "Instagram" },
              ].map(({ icon, label }) => (
                <a
                  key={label}
                  href="#"
                  aria-label={label}
                  className="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-white/70 hover:bg-primary hover:text-white transition-all duration-200"
                >
                  {icon}
                </a>
              ))}
            </div>
          </div>

          {/* Services */}
          <div>
            <h4 className="text-sm font-bold uppercase tracking-widest text-white/40 mb-5">Services</h4>
            <ul className="space-y-3">
              {SERVICES.map(({ label, href }) => (
                <li key={href}>
                  <Link href={href} className="text-sm text-white/70 hover:text-primary transition-colors flex items-center gap-1 group">
                    <span className="w-0 overflow-hidden group-hover:w-3 transition-all duration-200">›</span>
                    {label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Company */}
          <div>
            <h4 className="text-sm font-bold uppercase tracking-widest text-white/40 mb-5">Company</h4>
            <ul className="space-y-3">
              {COMPANY.map(({ label, href }) => (
                <li key={href}>
                  <Link href={href} className="text-sm text-white/70 hover:text-primary transition-colors flex items-center gap-1 group">
                    <span className="w-0 overflow-hidden group-hover:w-3 transition-all duration-200">›</span>
                    {label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact + Newsletter */}
          <div className="space-y-8">
            <div>
              <h4 className="text-sm font-bold uppercase tracking-widest text-white/40 mb-5">Contact</h4>
              <ul className="space-y-3 text-sm text-white/70">
                <li className="flex items-start gap-3">
                  <MapPin className="w-4 h-4 text-primary shrink-0 mt-0.5" />
                  <span>M-01, Muteena Street, Above Saravana Bhavan<br />Deira, Dubai, UAE</span>
                </li>
                <li className="flex items-center gap-3">
                  <Mail className="w-4 h-4 text-primary shrink-0" />
                  <a href="mailto:sales@searchengineoptimization.ae" className="hover:text-primary transition-colors">sales@searchengineoptimization.ae</a>
                </li>
                <li className="flex items-center gap-3">
                  <ExternalLink className="w-4 h-4 text-primary shrink-0" />
                  <a href="https://searchengineoptimization.ae" target="_blank" rel="noopener noreferrer" className="hover:text-primary transition-colors">searchengineoptimization.ae</a>
                </li>
              </ul>
            </div>

            <div>
              <h4 className="text-sm font-bold uppercase tracking-widest text-white/40 mb-4">Insights Newsletter</h4>
              <p className="text-xs text-white/50 mb-3">Weekly SEO tips, algorithm updates, and growth strategies.</p>
              <form onSubmit={handleSubscribe} className="flex gap-2">
                <Input
                  type="email"
                  placeholder="Your email address"
                  className="bg-white/10 border-white/20 text-white placeholder:text-white/40 focus:border-primary text-sm"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  disabled={subscribe.isPending}
                />
                <Button type="submit" size="icon" variant="default" disabled={subscribe.isPending} className="shrink-0">
                  <ArrowRight className="w-4 h-4" />
                </Button>
              </form>
            </div>
          </div>
        </div>

        {/* Certifications / Trust row */}
        <div className="py-6 border-t border-white/10 border-b border-white/10 mb-8">
          <div className="flex flex-wrap items-center justify-center gap-6 text-xs text-white/40 font-medium uppercase tracking-wider">
            {["Google Partner", "Meta Business Partner", "HubSpot Certified", "Clutch Top Agency", "ISO 27001"].map((cert) => (
              <span key={cert} className="flex items-center gap-1.5">
                <span className="w-1.5 h-1.5 rounded-full bg-primary/60" />
                {cert}
              </span>
            ))}
          </div>
        </div>

        {/* Bottom bar */}
        <div className="flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-white/40">
          <p>© {new Date().getFullYear()} SEO.ae · SearchEngineOptimization.ae · All rights reserved.</p>
          <div className="flex items-center gap-5">
            <Link href="/privacy" className="hover:text-white transition-colors">Privacy Policy</Link>
            <Link href="/terms" className="hover:text-white transition-colors">Terms of Service</Link>
            <Link href="/sitemap" className="hover:text-white transition-colors">Sitemap</Link>
          </div>
        </div>
      </div>
    </footer>
  );
}
