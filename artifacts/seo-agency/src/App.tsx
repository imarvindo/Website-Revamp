import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { Toaster } from '@/components/ui/toaster';
import { TooltipProvider } from '@/components/ui/tooltip';
import { Route, Switch, Router as WouterRouter } from 'wouter';

import Navbar from '@/components/layout/Navbar';
import Footer from '@/components/layout/Footer';
import ScrollToTop from '@/components/ScrollToTop';
import NotFound from '@/pages/not-found';

import Home from '@/pages/home';
import About from '@/pages/about';
import Services from '@/pages/services';
import SEO from '@/pages/services/seo';
import AISearch from '@/pages/services/ai-search-optimization';
import PPC from '@/pages/services/ppc';
import SocialMedia from '@/pages/services/social-media-marketing';
import WebDesign from '@/pages/services/web-design';
import WebDevelopment from '@/pages/services/web-development';
import BlogList from '@/pages/blog';
import BlogPost from '@/pages/blog/single';
import CaseStudies from '@/pages/case-studies';
import Portfolio from '@/pages/portfolio';
import Contact from '@/pages/contact';
import Careers from '@/pages/careers';
import LocationDubai from '@/pages/locations/dubai';

const queryClient = new QueryClient();

function Router() {
  return (
    <div className="flex flex-col min-h-screen">
      <Navbar />
      <main className="flex-1">
        <Switch>
          <Route path="/" component={Home} />
          <Route path="/about" component={About} />
          <Route path="/services" component={Services} />
          <Route path="/seo" component={SEO} />
          <Route path="/services/seo" component={SEO} />
          <Route path="/ai-search-optimization" component={AISearch} />
          <Route path="/services/ai-search-optimization" component={AISearch} />
          <Route path="/ppc" component={PPC} />
          <Route path="/services/ppc" component={PPC} />
          <Route path="/social-media-marketing" component={SocialMedia} />
          <Route path="/services/social-media-marketing" component={SocialMedia} />
          <Route path="/web-design" component={WebDesign} />
          <Route path="/services/web-design" component={WebDesign} />
          <Route path="/web-development" component={WebDevelopment} />
          <Route path="/services/web-development" component={WebDevelopment} />
          <Route path="/blog" component={BlogList} />
          <Route path="/blog/:slug" component={BlogPost} />
          <Route path="/case-studies" component={CaseStudies} />
          <Route path="/portfolio" component={Portfolio} />
          <Route path="/contact" component={Contact} />
          <Route path="/careers" component={Careers} />
          <Route path="/locations/dubai" component={LocationDubai} />
          <Route component={NotFound} />
        </Switch>
      </main>
      <Footer />
    </div>
  );
}

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <TooltipProvider>
        <WouterRouter base={import.meta.env.BASE_URL.replace(/\/$/, '')}>
          <ScrollToTop />
          <Router />
        </WouterRouter>
        <Toaster />
      </TooltipProvider>
    </QueryClientProvider>
  );
}

export default App;