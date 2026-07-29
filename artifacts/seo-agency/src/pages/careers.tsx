import { Link } from "wouter";
import { Button } from "@/components/ui/button";

export default function Careers() {
  return (
    <div className="flex flex-col min-h-screen">
      <section className="pt-40 pb-20 relative overflow-hidden bg-background">
        <div className="container mx-auto px-4 text-center max-w-3xl relative z-10">
          <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6">
            Join the <span className="text-primary">Elite</span>
          </h1>
          <p className="text-xl text-white/70 mb-10 leading-relaxed">
            We're always looking for brilliant minds to join our Dubai headquarters. If you're obsessed with performance and growth, we want to talk.
          </p>
          <div className="inline-block px-4 py-2 bg-white/5 rounded-full border border-white/10 text-white/60 mb-12">
            No open positions currently. Check back later.
          </div>
          <div className="mt-8">
            <Link href="/contact"><Button variant="outline">Send General Application</Button></Link>
          </div>
        </div>
      </section>
    </div>
  );
}