import { useState, useEffect } from "react";
import { Link, useLocation } from "wouter";
import { Button } from "@/components/ui/button";
import {
  Menu, X, ChevronDown, BarChart, Search, Globe, Code, PenTool,
  TrendingUp, Smartphone, Phone, Mail, MapPin
} from "lucide-react";
import { cn } from "@/lib/utils";
import { motion, AnimatePresence } from "framer-motion";

const SERVICES = [
  { title: "Enterprise SEO", href: "/seo", icon: TrendingUp, desc: "Dominate organic rankings" },
  { title: "AI Search Optimization", href: "/ai-search-optimization", icon: Search, desc: "GEO, LLM & AI Overview" },
  { title: "PPC & Google Ads", href: "/ppc", icon: BarChart, desc: "High-ROI paid campaigns" },
  { title: "Social Media Marketing", href: "/social-media-marketing", icon: Smartphone, desc: "Strategic brand growth" },
  { title: "Premium Web Design", href: "/web-design", icon: PenTool, desc: "Conversion-led design" },
  { title: "Web Development", href: "/web-development", icon: Code, desc: "Fast, scalable apps" },
];

export default function Navbar() {
  const [location] = useLocation();
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [servicesOpen, setServicesOpen] = useState(false);
  const [resourcesOpen, setResourcesOpen] = useState(false);
  const [companyOpen, setCompanyOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => setIsScrolled(window.scrollY > 20);
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  useEffect(() => {
    setMobileMenuOpen(false);
    setServicesOpen(false);
  }, [location]);

  const isActive = (href: string) =>
    href === "/" ? location === "/" : location.startsWith(href);

  return (
    <header
      className={cn(
        "fixed top-0 left-0 right-0 z-50 transition-all duration-300",
        isScrolled
          ? "bg-white/95 backdrop-blur-md border-b border-border shadow-sm"
          : "bg-white border-b border-border"
      )}
    >
      {/* Top bar */}
      <div className="hidden lg:block bg-secondary text-white/80 text-xs py-2 border-b border-white/10">
        <div className="container mx-auto px-4 flex items-center justify-between">
          <div className="flex items-center gap-6">
            <span className="flex items-center gap-1.5">
              <MapPin className="w-3 h-3" /> M-01, Muteena Street, Deira, Dubai, UAE
            </span>
          </div>
          <div className="flex items-center gap-6">
            <span className="flex items-center gap-1.5">
              <Mail className="w-3 h-3" /> sales@searchengineoptimization.ae
            </span>
            <span className="text-white/40">|</span>
            <Link href="/careers" className="hover:text-white transition-colors">Careers</Link>
            <Link href="/blog" className="hover:text-white transition-colors">Blog</Link>
          </div>
        </div>
      </div>

      {/* Main nav */}
      <div className="container mx-auto px-4 h-18 py-3 flex items-center justify-between">
        {/* Logo */}
        <Link href="/" className="flex items-center gap-2 group shrink-0">
          <div className="w-9 h-9 rounded-lg bg-primary flex items-center justify-center shadow-sm">
            <Globe className="w-5 h-5 text-white" />
          </div>
          <div className="flex flex-col leading-none">
            <span className="text-xl font-bold tracking-tight text-secondary">
              SEO<span className="text-primary">.ae</span>
            </span>
            <span className="text-[10px] text-muted-foreground uppercase tracking-widest font-medium hidden sm:block">
              Digital Growth Partner
            </span>
          </div>
        </Link>

        {/* Desktop Nav */}
        <nav className="hidden lg:flex items-center gap-1">
          <Link
            href="/"
            className={cn(
              "px-4 py-2 text-sm font-medium rounded-md transition-colors",
              isActive("/") ? "text-primary bg-primary/8" : "text-foreground/80 hover:text-primary hover:bg-muted"
            )}
          >
            Home
          </Link>

          {/* Services Mega Menu */}
          <div
            className="relative"
            onMouseEnter={() => setServicesOpen(true)}
            onMouseLeave={() => setServicesOpen(false)}
          >
            <button
              className={cn(
                "flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-md transition-colors",
                location.startsWith("/seo") || location.startsWith("/ppc") || location.startsWith("/social") || location.startsWith("/web") || location.startsWith("/ai-search")
                  ? "text-primary bg-primary/8"
                  : "text-foreground/80 hover:text-primary hover:bg-muted"
              )}
            >
              Services
              <ChevronDown className={cn("w-4 h-4 transition-transform duration-200", servicesOpen && "rotate-180")} />
            </button>

            <AnimatePresence>
              {servicesOpen && (
                <motion.div
                  initial={{ opacity: 0, y: 8, scale: 0.97 }}
                  animate={{ opacity: 1, y: 0, scale: 1 }}
                  exit={{ opacity: 0, y: 8, scale: 0.97 }}
                  transition={{ duration: 0.15 }}
                  className="absolute top-full left-1/2 -translate-x-1/2 w-[620px] bg-white border border-border rounded-2xl shadow-xl p-4 grid grid-cols-2 gap-1.5 mt-1"
                >
                  <div className="col-span-2 px-3 pb-2 mb-1 border-b border-border flex justify-between items-center">
                    <span className="text-xs font-bold text-muted-foreground uppercase tracking-wider">Our Services</span>
                    <Link href="/services" className="text-xs text-primary hover:underline font-medium">
                      View All Services →
                    </Link>
                  </div>
                  {SERVICES.map((service) => (
                    <Link
                      key={service.href}
                      href={service.href}
                      className="flex items-start gap-3 p-3 rounded-xl hover:bg-muted transition-colors group"
                    >
                      <div className="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary/20 transition-colors">
                        <service.icon className="w-4 h-4 text-primary" />
                      </div>
                      <div>
                        <div className="text-sm font-semibold text-foreground group-hover:text-primary transition-colors">
                          {service.title}
                        </div>
                        <div className="text-xs text-muted-foreground mt-0.5">{service.desc}</div>
                      </div>
                    </Link>
                  ))}
                </motion.div>
              )}
            </AnimatePresence>
          </div>

          {/* Resources */}
          <div
            className="relative"
            onMouseEnter={() => setResourcesOpen(true)}
            onMouseLeave={() => setResourcesOpen(false)}
          >
            <button
              className={cn(
                "flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-md transition-colors",
                (isActive("/blog") || isActive("/case-studies") || isActive("/portfolio"))
                  ? "text-primary bg-primary/8"
                  : "text-foreground/80 hover:text-primary hover:bg-muted"
              )}
            >
              Resources
              <ChevronDown className={cn("w-4 h-4 transition-transform duration-200", resourcesOpen && "rotate-180")} />
            </button>
            <AnimatePresence>
              {resourcesOpen && (
                <motion.div
                  initial={{ opacity: 0, y: 8 }}
                  animate={{ opacity: 1, y: 0 }}
                  exit={{ opacity: 0, y: 8 }}
                  transition={{ duration: 0.15 }}
                  className="absolute top-full left-1/2 -translate-x-1/2 w-52 bg-white border border-border rounded-xl shadow-xl p-2 mt-1"
                >
                  {[
                    { href: "/case-studies", label: "Case Studies" },
                    { href: "/portfolio", label: "Portfolio" },
                    { href: "/blog", label: "Insights & Blog" },
                  ].map((item) => (
                    <Link
                      key={item.href}
                      href={item.href}
                      className="flex items-center px-3 py-2.5 text-sm text-foreground/80 hover:text-primary hover:bg-muted rounded-lg transition-colors"
                    >
                      {item.label}
                    </Link>
                  ))}
                </motion.div>
              )}
            </AnimatePresence>
          </div>

          {/* Company */}
          <div
            className="relative"
            onMouseEnter={() => setCompanyOpen(true)}
            onMouseLeave={() => setCompanyOpen(false)}
          >
            <button
              className={cn(
                "flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-md transition-colors",
                (isActive("/about") || isActive("/careers") || isActive("/contact"))
                  ? "text-primary bg-primary/8"
                  : "text-foreground/80 hover:text-primary hover:bg-muted"
              )}
            >
              Company
              <ChevronDown className={cn("w-4 h-4 transition-transform duration-200", companyOpen && "rotate-180")} />
            </button>
            <AnimatePresence>
              {companyOpen && (
                <motion.div
                  initial={{ opacity: 0, y: 8 }}
                  animate={{ opacity: 1, y: 0 }}
                  exit={{ opacity: 0, y: 8 }}
                  transition={{ duration: 0.15 }}
                  className="absolute top-full left-1/2 -translate-x-1/2 w-52 bg-white border border-border rounded-xl shadow-xl p-2 mt-1"
                >
                  {[
                    { href: "/about", label: "About Us" },
                    { href: "/careers", label: "Careers" },
                    { href: "/locations/dubai", label: "Dubai Office" },
                    { href: "/contact", label: "Contact" },
                  ].map((item) => (
                    <Link
                      key={item.href}
                      href={item.href}
                      className="flex items-center px-3 py-2.5 text-sm text-foreground/80 hover:text-primary hover:bg-muted rounded-lg transition-colors"
                    >
                      {item.label}
                    </Link>
                  ))}
                </motion.div>
              )}
            </AnimatePresence>
          </div>
        </nav>

        {/* CTA */}
        <div className="hidden lg:flex items-center gap-3">
          <Link href="/contact">
            <Button variant="outline" size="sm">Free Audit</Button>
          </Link>
          <Link href="/contact">
            <Button size="sm" className="rounded-full px-5">Get Started →</Button>
          </Link>
        </div>

        {/* Mobile Toggle */}
        <button
          className="lg:hidden p-2 text-foreground rounded-md hover:bg-muted transition-colors"
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
            transition={{ duration: 0.2 }}
            className="lg:hidden bg-white border-t border-border overflow-hidden shadow-lg"
          >
            <div className="px-4 py-6 flex flex-col gap-1">
              <Link href="/" className="px-3 py-2.5 text-base font-medium text-foreground hover:text-primary hover:bg-muted rounded-lg transition-colors">
                Home
              </Link>
              <div className="px-3 py-2 text-xs font-bold text-muted-foreground uppercase tracking-wider mt-2">Services</div>
              {SERVICES.map(s => (
                <Link key={s.href} href={s.href} className="px-3 py-2 text-sm text-foreground/80 hover:text-primary hover:bg-muted rounded-lg transition-colors flex items-center gap-2">
                  <s.icon className="w-4 h-4 text-primary/60" />
                  {s.title}
                </Link>
              ))}
              <div className="my-2 h-px bg-border" />
              <Link href="/case-studies" className="px-3 py-2.5 text-base font-medium text-foreground hover:text-primary hover:bg-muted rounded-lg transition-colors">Case Studies</Link>
              <Link href="/portfolio" className="px-3 py-2.5 text-base font-medium text-foreground hover:text-primary hover:bg-muted rounded-lg transition-colors">Portfolio</Link>
              <Link href="/blog" className="px-3 py-2.5 text-base font-medium text-foreground hover:text-primary hover:bg-muted rounded-lg transition-colors">Blog</Link>
              <Link href="/about" className="px-3 py-2.5 text-base font-medium text-foreground hover:text-primary hover:bg-muted rounded-lg transition-colors">About Us</Link>
              <div className="mt-3 flex flex-col gap-2">
                <Link href="/contact">
                  <Button variant="outline" className="w-full">Free SEO Audit</Button>
                </Link>
                <Link href="/contact">
                  <Button className="w-full">Get Started</Button>
                </Link>
              </div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </header>
  );
}
