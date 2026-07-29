import { Link } from "wouter";
import { Button } from "@/components/ui/button";

export default function NotFound() {
  return (
    <div className="min-h-[100dvh] w-full flex items-center justify-center bg-background bg-grid-pattern relative overflow-hidden">
      {/* Decorative blobs */}
      <div className="absolute top-1/4 left-1/4 w-[400px] h-[400px] bg-primary/10 rounded-full blur-[100px] -z-10 mix-blend-multiply animate-float" />
      <div className="absolute bottom-1/4 right-1/4 w-[300px] h-[300px] bg-accent/10 rounded-full blur-[80px] -z-10 mix-blend-multiply animate-float" style={{ animationDelay: "2s" }} />

      <div className="text-center relative z-10 space-y-8 max-w-md px-4">
        <div className="space-y-4">
          <h1 className="text-8xl md:text-9xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">
            404
          </h1>
          <h2 className="text-3xl md:text-4xl font-bold text-foreground tracking-tight">
            Page Not Found
          </h2>
          <p className="text-lg text-muted-foreground font-medium">
            The page you're looking for doesn't exist or has been moved.
          </p>
        </div>
        
        <div className="pt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
          <Link href="/">
            <Button size="lg" className="w-full sm:w-auto h-12 px-8">
              Return Home
            </Button>
          </Link>
          <Link href="/services">
            <Button variant="outline" size="lg" className="w-full sm:w-auto h-12 px-8">
              Our Services
            </Button>
          </Link>
        </div>
      </div>
    </div>
  );
}