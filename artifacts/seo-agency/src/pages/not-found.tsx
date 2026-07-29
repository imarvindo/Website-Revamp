import { Link } from "wouter";
import { Button } from "@/components/ui/button";

export default function NotFound() {
  return (
    <div className="min-h-[100dvh] w-full flex items-center justify-center bg-background bg-grid-pattern relative overflow-hidden">
      <div className="absolute inset-0 bg-background/80 backdrop-blur-[2px]" />
      
      {/* Decorative blobs */}
      <div className="absolute top-1/4 left-1/4 w-[400px] h-[400px] bg-primary/20 rounded-full blur-[100px] -z-10 mix-blend-screen animate-float" />
      <div className="absolute bottom-1/4 right-1/4 w-[300px] h-[300px] bg-accent/10 rounded-full blur-[80px] -z-10 mix-blend-screen animate-float" style={{ animationDelay: "2s" }} />

      <div className="text-center relative z-10 space-y-6 max-w-md px-4">
        <div className="space-y-2">
          <h1 className="text-7xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-400">
            404
          </h1>
          <h2 className="text-2xl font-semibold text-foreground">
            Signal Lost
          </h2>
          <p className="text-muted-foreground">
            The page you're looking for has been moved, deleted, or doesn't exist.
          </p>
        </div>
        
        <div className="pt-4 flex items-center justify-center gap-4">
          <Link href="/">
            <Button variant="default" className="w-full sm:w-auto">
              Return Home
            </Button>
          </Link>
          <Link href="/services">
            <Button variant="outline" className="w-full sm:w-auto">
              Our Services
            </Button>
          </Link>
        </div>
      </div>
    </div>
  );
}