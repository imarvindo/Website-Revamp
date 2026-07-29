import { useState, useEffect } from "react";
import { Link, useLocation } from "wouter";
import { Button } from "@/components/ui/button";
import { Menu, X, ChevronDown, BarChart, Search, Globe, Code, PenTool, TrendingUp, Smartphone } from "lucide-react";
import { cn } from "@/lib/utils";
import { motion, AnimatePresence } from "framer-motion";

const SERVICES = [
  { title: "SEO", href: "/seo", icon: TrendingUp, desc: "Dominate search rankings" },
  { title: "AI Search Optimization", href: "/ai-search-optimization", icon: Search, desc: "GEO & LLM optimization" },
  { title: "PPC & Google Ads", href: "/ppc", icon: BarChart, desc: "High-ROI paid campaigns" },
  { title: "Social Media", href: "/social-media-marketing", icon: Smartphone, desc: "Strategic brand growth" },
  { title: "Web Design", href: "/web-design", icon: PenTool, desc: "Conversion-focused design" },
  { title: "Web Development", href: "/web-development", icon: Code, desc: "High-performance apps" }
];

export default function Navbar() {
  const [location] = useLocation();
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [servicesOpen, setServicesOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => setIsScrolled(window.scrollY > 20);
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  // Close mobile menu on navigation
  useEffect(() => {
    setMobileMenuOpen(false);
    setServicesOpen(false);
  }, [location]);

  return (
    <header 
      className={cn(
        "fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-transparent",
        isScrolled ? "bg-background/80 backdrop-blur-md border-white/10 shadow-lg" : "bg-transparent py-2"
      )}
    >
      <div className="container mx-auto px-4 h-20 flex items-center justify-between">
        <Link href="/" className="flex items-center gap-2 group">
          <div className="w-8 h-8 rounded bg-primary/20 flex items-center justify-center group-hover:bg-primary/30 transition-colors">
            <Globe className="w-5 h-5 text-primary" />
          </div>
          <span className="text-xl font-bold tracking-tight text-white">SEO<span className="text-accent">.ae</span></span>
        </Link>

        {/* Desktop Nav */}
        <nav className="hidden lg:flex items-center gap-8">
          <Link href="/" className={cn("text-sm font-medium transition-colors hover:text-primary", location === "/" ? "text-primary" : "text-white/80")}>
            Home
          </Link>
          
          <div 
            className="relative"
            onMouseEnter={() => setServicesOpen(true)}
            onMouseLeave={() => setServicesOpen(false)}
          >
            <button className={cn("flex items-center gap-1 text-sm font-medium transition-colors hover:text-primary py-4", location.startsWith("/services") ? "text-primary" : "text-white/80")}>
              Services <ChevronDown className={cn("w-4 h-4 transition-transform duration-200", servicesOpen && "rotate-180")} />
            </button>
            
            <AnimatePresence>
              {servicesOpen && (
                <motion.div
                  initial={{ opacity: 0, y: 10, scale: 0.95 }}
                  animate={{ opacity: 1, y: 0, scale: 1 }}
                  exit={{ opacity: 0, y: 10, scale: 0.95 }}
                  transition={{ duration: 0.2 }}
                  className="absolute top-full left-1/2 -translate-x-1/2 w-[600px] bg-card border border-white/10 rounded-xl shadow-2xl p-4 grid grid-cols-2 gap-2"
                >
                  <div className="col-span-2 pb-2 mb-2 border-b border-white/10 flex justify-between items-center px-2">
                    <span className="text-sm font-semibold text-white/50 uppercase tracking-wider">All Services</span>
                    <Link href="/services" className="text-xs text-primary hover:underline">View All &rarr;</Link>
                  </div>
                  {SERVICES.map((service) => (
                    <Link key={service.href} href={service.href} className="flex items-start gap-3 p-3 rounded-lg hover:bg-white/5 transition-colors group">
                      <div className="w-10 h-10 rounded-md bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary/20 transition-colors">
                        <service.icon className="w-5 h-5 text-primary" />
                      </div>
                      <div>
                        <div className="text-sm font-semibold text-white group-hover:text-primary transition-colors">{service.title}</div>
                        <div className="text-xs text-white/50">{service.desc}</div>
                      </div>
                    </Link>
                  ))}
                </motion.div>
              )}
            </AnimatePresence>
          </div>

          <div className="relative group">
            <button className={cn("flex items-center gap-1 text-sm font-medium transition-colors hover:text-primary py-4", (location === "/blog" || location === "/case-studies" || location === "/portfolio") ? "text-primary" : "text-white/80")}>
              Resources <ChevronDown className="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" />
            </button>
            <div className="absolute top-full left-1/2 -translate-x-1/2 w-48 bg-card border border-white/10 rounded-xl shadow-2xl p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-y-2 group-hover:translate-y-0">
              <Link href="/case-studies" className="block px-4 py-2 text-sm text-white/80 hover:text-primary hover:bg-white/5 rounded-md transition-colors">Case Studies</Link>
              <Link href="/portfolio" className="block px-4 py-2 text-sm text-white/80 hover:text-primary hover:bg-white/5 rounded-md transition-colors">Portfolio</Link>
              <Link href="/blog" className="block px-4 py-2 text-sm text-white/80 hover:text-primary hover:bg-white/5 rounded-md transition-colors">Blog</Link>
            </div>
          </div>

          <div className="relative group">
            <button className={cn("flex items-center gap-1 text-sm font-medium transition-colors hover:text-primary py-4", (location === "/about" || location === "/careers" || location === "/contact") ? "text-primary" : "text-white/80")}>
              Company <ChevronDown className="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" />
            </button>
            <div className="absolute top-full left-1/2 -translate-x-1/2 w-48 bg-card border border-white/10 rounded-xl shadow-2xl p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-y-2 group-hover:translate-y-0">
              <Link href="/about" className="block px-4 py-2 text-sm text-white/80 hover:text-primary hover:bg-white/5 rounded-md transition-colors">About Us</Link>
              <Link href="/careers" className="block px-4 py-2 text-sm text-white/80 hover:text-primary hover:bg-white/5 rounded-md transition-colors">Careers</Link>
              <Link href="/contact" className="block px-4 py-2 text-sm text-white/80 hover:text-primary hover:bg-white/5 rounded-md transition-colors">Contact</Link>
            </div>
          </div>
        </nav>

        <div className="hidden lg:flex items-center gap-4">
          <Link href="/contact">
            <Button variant="gold" className="rounded-full">Get Free Audit</Button>
          </Link>
        </div>

        {/* Mobile Toggle */}
        <button 
          className="lg:hidden p-2 text-white/80 hover:text-white"
          onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
          aria-label="Toggle Menu"
        >
          {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
        </button>
      </div>

      {/* Mobile Menu */}
      <AnimatePresence>
        {mobileMenuOpen && (
          <motion.div
            initial={{ height: 0, opacity: 0 }}
            animate={{ height: "auto", opacity: 1 }}
            exit={{ height: 0, opacity: 0 }}
            className="lg:hidden bg-card border-b border-white/10 overflow-hidden"
          >
            <div className="px-4 py-6 flex flex-col gap-4">
              <Link href="/" className="text-lg font-medium text-white/90">Home</Link>
              <Link href="/services" className="text-lg font-medium text-white/90">Services</Link>
              <div className="pl-4 flex flex-col gap-3 border-l border-white/10">
                {SERVICES.map(s => (
                  <Link key={s.href} href={s.href} className="text-sm text-white/60">{s.title}</Link>
                ))}
              </div>
              <Link href="/case-studies" className="text-lg font-medium text-white/90">Case Studies</Link>
              <Link href="/portfolio" className="text-lg font-medium text-white/90">Portfolio</Link>
              <Link href="/blog" className="text-lg font-medium text-white/90">Blog</Link>
              <Link href="/about" className="text-lg font-medium text-white/90">About Us</Link>
              <Link href="/contact" className="text-lg font-medium text-white/90 mt-2">
                <Button variant="gold" className="w-full">Get Free Audit</Button>
              </Link>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </header>
  );
}