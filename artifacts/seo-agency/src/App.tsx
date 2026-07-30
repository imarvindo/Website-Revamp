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
import ShopifyDevelopment from '@/pages/services/shopify-development';
import LaravelDevelopment from '@/pages/services/laravel-development';
import SaasDevelopment from '@/pages/services/saas-development';
import MobileAppDevelopment from '@/pages/services/mobile-app-development';
import ReputationManagement from '@/pages/services/reputation-management';
import GoogleBusinessProfile from '@/pages/services/google-business-profile';
import MvpDevelopment from '@/pages/services/mvp-development';
import BlogList from '@/pages/blog';
import BlogPost from '@/pages/blog/single';
import CaseStudies from '@/pages/case-studies';
import Portfolio from '@/pages/portfolio';
import Contact from '@/pages/contact';
import Careers from '@/pages/careers';
import LocationDubai from '@/pages/locations/dubai';
import FAQ from '@/pages/faq';
import Privacy from '@/pages/privacy';
import Terms from '@/pages/terms';

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
          <Route path="/shopify-development" component={ShopifyDevelopment} />
          <Route path="/services/shopify-development" component={ShopifyDevelopment} />
          <Route path="/laravel-development" component={LaravelDevelopment} />
          <Route path="/services/laravel-development" component={LaravelDevelopment} />
          <Route path="/saas-development" component={SaasDevelopment} />
          <Route path="/services/saas-development" component={SaasDevelopment} />
          <Route path="/mobile-app-development" component={MobileAppDevelopment} />
          <Route path="/services/mobile-app-development" component={MobileAppDevelopment} />
          <Route path="/reputation-management" component={ReputationManagement} />
          <Route path="/services/reputation-management" component={ReputationManagement} />
          <Route path="/google-business-profile" component={GoogleBusinessProfile} />
          <Route path="/services/google-business-profile" component={GoogleBusinessProfile} />
          <Route path="/mvp-development" component={MvpDevelopment} />
          <Route path="/services/mvp-development" component={MvpDevelopment} />
          <Route path="/blog" component={BlogList} />
          <Route path="/blog/:slug" component={BlogPost} />
          <Route path="/case-studies" component={CaseStudies} />
          <Route path="/portfolio" component={Portfolio} />
          <Route path="/contact" component={Contact} />
          <Route path="/careers" component={Careers} />
          <Route path="/locations/dubai" component={LocationDubai} />
          <Route path="/faq" component={FAQ} />
          <Route path="/privacy" component={Privacy} />
          <Route path="/terms" component={Terms} />
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