import { useSubmitContact } from "@workspace/api-client-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { useToast } from "@/hooks/use-toast";
import { Mail, MapPin, Phone } from "lucide-react";
import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { Form, FormControl, FormField, FormItem, FormLabel, FormMessage } from "@/components/ui/form";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";

const contactSchema = z.object({
  name: z.string().min(2, "Name is required"),
  email: z.string().email("Invalid email address"),
  phone: z.string().optional(),
  company: z.string().optional(),
  service: z.string().optional(),
  budget: z.string().optional(),
  message: z.string().min(10, "Message must be at least 10 characters")
});

export default function Contact() {
  const { toast } = useToast();
  const submitContact = useSubmitContact();
  
  const form = useForm<z.infer<typeof contactSchema>>({
    resolver: zodResolver(contactSchema),
    defaultValues: {
      name: "", email: "", phone: "", company: "", service: "", budget: "", message: ""
    }
  });

  const onSubmit = (values: z.infer<typeof contactSchema>) => {
    submitContact.mutate({ data: values }, {
      onSuccess: () => {
        toast({ title: "Message sent", description: "We'll get back to you within 24 hours." });
        form.reset();
      },
      onError: () => {
        toast({ variant: "destructive", title: "Error", description: "Failed to send message. Please try again." });
      }
    });
  };

  return (
    <div className="flex flex-col min-h-screen bg-background">
      {/* Dark Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-32 relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 text-center max-w-3xl">
          <div className="section-label bg-white/10 text-white border-white/20 mb-6">Contact Us</div>
          <h1 className="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
            Let's Talk <span className="gradient-text-primary">Growth</span>
          </h1>
          <p className="text-xl text-white/80 max-w-2xl mx-auto font-light">
            Ready to dominate your market? Reach out and our growth experts will audit your digital presence.
          </p>
        </div>
      </section>

      {/* Main Content (Light) */}
      <section className="py-24 -mt-20 relative z-20">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-12 gap-12 items-start">
            
            {/* Contact Info */}
            <div className="lg:col-span-5 space-y-8 bg-white border border-border p-10 rounded-3xl shadow-sm">
              <div>
                <h3 className="text-2xl font-bold text-foreground mb-8">Get in Touch</h3>
              </div>
              
              <div className="flex items-start gap-5">
                <div className="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0 border border-primary/20">
                  <MapPin className="w-6 h-6 text-primary" />
                </div>
                <div>
                  <h4 className="text-lg font-bold text-foreground mb-1">Dubai Headquarters</h4>
                  <p className="text-muted-foreground leading-relaxed">M-01, Muteena Street, Above Saravana Bhavan<br/>Deira, Dubai, UAE</p>
                </div>
              </div>
              
              <div className="flex items-start gap-5">
                <div className="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0 border border-primary/20">
                  <Phone className="w-6 h-6 text-primary" />
                </div>
                <div>
                  <h4 className="text-lg font-bold text-foreground mb-1">Call Us</h4>
                  <p className="text-muted-foreground leading-relaxed">
                    <a href="tel:+97142524900" className="hover:text-primary transition-colors">+971 4 252 4900</a>
                    <br/><span className="text-sm">Sun–Thu, 9 am – 6 pm GST</span>
                  </p>
                </div>
              </div>

              <div className="flex items-start gap-5">
                <div className="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0 border border-primary/20">
                  <Mail className="w-6 h-6 text-primary" />
                </div>
                <div>
                  <h4 className="text-lg font-bold text-foreground mb-1">Email Us</h4>
                  <p className="text-muted-foreground leading-relaxed">
                    <a href="mailto:sales@searchengineoptimization.ae" className="hover:text-primary transition-colors">sales@searchengineoptimization.ae</a>
                    <br/><span className="text-sm">We respond within 24 hours</span>
                  </p>
                </div>
              </div>
            </div>
            
            {/* Form */}
            <div className="lg:col-span-7 bg-white border border-border rounded-3xl p-10 shadow-xl">
              <h3 className="text-2xl font-bold text-foreground mb-8">Request a Proposal</h3>
              <Form {...form}>
                <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6">
                  <div className="grid md:grid-cols-2 gap-6">
                    <FormField control={form.control} name="name" render={({ field }) => (
                      <FormItem>
                        <FormLabel className="text-foreground font-semibold">Full Name *</FormLabel>
                        <FormControl><Input placeholder="John Doe" className="h-12 bg-muted/50 border-border" {...field} /></FormControl>
                        <FormMessage />
                      </FormItem>
                    )} />
                    <FormField control={form.control} name="email" render={({ field }) => (
                      <FormItem>
                        <FormLabel className="text-foreground font-semibold">Email *</FormLabel>
                        <FormControl><Input placeholder="john@company.com" type="email" className="h-12 bg-muted/50 border-border" {...field} /></FormControl>
                        <FormMessage />
                      </FormItem>
                    )} />
                  </div>
                  <div className="grid md:grid-cols-2 gap-6">
                    <FormField control={form.control} name="phone" render={({ field }) => (
                      <FormItem>
                        <FormLabel className="text-foreground font-semibold">Phone</FormLabel>
                        <FormControl><Input placeholder="+971 50 000 0000" className="h-12 bg-muted/50 border-border" {...field} /></FormControl>
                        <FormMessage />
                      </FormItem>
                    )} />
                    <FormField control={form.control} name="company" render={({ field }) => (
                      <FormItem>
                        <FormLabel className="text-foreground font-semibold">Company</FormLabel>
                        <FormControl><Input placeholder="Acme Corp" className="h-12 bg-muted/50 border-border" {...field} /></FormControl>
                        <FormMessage />
                      </FormItem>
                    )} />
                  </div>
                  <div className="grid md:grid-cols-2 gap-6">
                    <FormField control={form.control} name="service" render={({ field }) => (
                      <FormItem>
                        <FormLabel className="text-foreground font-semibold">Service of Interest</FormLabel>
                        <Select onValueChange={field.onChange} defaultValue={field.value}>
                          <FormControl>
                            <SelectTrigger className="h-12 bg-muted/50 border-border">
                              <SelectValue placeholder="Select service" />
                            </SelectTrigger>
                          </FormControl>
                          <SelectContent>
                            <SelectItem value="seo">Enterprise SEO</SelectItem>
                            <SelectItem value="ai">AI Search</SelectItem>
                            <SelectItem value="ppc">PPC & Ads</SelectItem>
                            <SelectItem value="web">Web Design</SelectItem>
                            <SelectItem value="other">Other</SelectItem>
                          </SelectContent>
                        </Select>
                        <FormMessage />
                      </FormItem>
                    )} />
                    <FormField control={form.control} name="budget" render={({ field }) => (
                      <FormItem>
                        <FormLabel className="text-foreground font-semibold">Monthly Budget</FormLabel>
                        <Select onValueChange={field.onChange} defaultValue={field.value}>
                          <FormControl>
                            <SelectTrigger className="h-12 bg-muted/50 border-border">
                              <SelectValue placeholder="Select budget" />
                            </SelectTrigger>
                          </FormControl>
                          <SelectContent>
                            <SelectItem value="5k-10k">$5k - $10k</SelectItem>
                            <SelectItem value="10k-25k">$10k - $25k</SelectItem>
                            <SelectItem value="25k+">$25k+</SelectItem>
                          </SelectContent>
                        </Select>
                        <FormMessage />
                      </FormItem>
                    )} />
                  </div>
                  <FormField control={form.control} name="message" render={({ field }) => (
                    <FormItem>
                      <FormLabel className="text-foreground font-semibold">Message *</FormLabel>
                      <FormControl><Textarea placeholder="Tell us about your goals..." className="min-h-[140px] bg-muted/50 border-border resize-none" {...field} /></FormControl>
                      <FormMessage />
                    </FormItem>
                  )} />
                  <Button type="submit" size="lg" className="w-full h-14 text-base" disabled={submitContact.isPending}>
                    {submitContact.isPending ? "Sending..." : "Send Message"}
                  </Button>
                </form>
              </Form>
            </div>

          </div>
        </div>
      </section>

      {/* Dark CTA Bottom */}
      <section className="py-24 hero-dark bg-grid-pattern-dark relative overflow-hidden mt-auto">
        <div className="container mx-auto px-4 text-center">
          <h2 className="text-3xl font-bold text-white mb-6">Ready to grow your business?</h2>
          <a href="mailto:sales@searchengineoptimization.ae">
            <Button variant="inverted" size="lg" className="h-14 px-10 text-lg gap-2">
              <Mail className="w-5 h-5" /> sales@searchengineoptimization.ae
            </Button>
          </a>
        </div>
      </section>
    </div>
  );
}