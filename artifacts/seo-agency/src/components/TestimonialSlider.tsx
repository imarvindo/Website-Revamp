import { Testimonial } from "@workspace/api-client-react";
import useEmblaCarousel from "embla-carousel-react";
import { Star, Quote } from "lucide-react";
import { useCallback, useEffect, useState } from "react";
import { Button } from "./ui/button";

export function TestimonialSlider({ testimonials }: { testimonials: Testimonial[] }) {
  const [emblaRef, emblaApi] = useEmblaCarousel({ loop: true });
  const [selectedIndex, setSelectedIndex] = useState(0);

  const scrollPrev = useCallback(() => emblaApi && emblaApi.scrollPrev(), [emblaApi]);
  const scrollNext = useCallback(() => emblaApi && emblaApi.scrollNext(), [emblaApi]);

  const onSelect = useCallback(() => {
    if (!emblaApi) return;
    setSelectedIndex(emblaApi.selectedScrollSnap());
  }, [emblaApi, setSelectedIndex]);

  useEffect(() => {
    if (!emblaApi) return;
    onSelect();
    emblaApi.on("select", onSelect);
  }, [emblaApi, onSelect]);

  if (!testimonials?.length) return null;

  return (
    <div className="relative max-w-4xl mx-auto">
      <div className="overflow-hidden" ref={emblaRef}>
        <div className="flex touch-pan-y">
          {testimonials.map((t) => (
            <div key={t.id} className="min-w-0 flex-[0_0_100%] px-4">
              <div className="bg-card/50 backdrop-blur border border-white/10 rounded-2xl p-8 md:p-12 relative">
                <Quote className="absolute top-8 right-8 w-12 h-12 text-primary/10" />
                <div className="flex gap-1 mb-6">
                  {Array.from({ length: t.rating }).map((_, i) => (
                    <Star key={i} className="w-5 h-5 fill-accent text-accent" />
                  ))}
                </div>
                <p className="text-xl md:text-2xl text-white/90 leading-relaxed mb-8 italic">"{t.content}"</p>
                <div className="flex items-center gap-4">
                  {t.avatarUrl ? (
                    <img src={t.avatarUrl} alt={t.name} className="w-14 h-14 rounded-full object-cover bg-white/5" />
                  ) : (
                    <div className="w-14 h-14 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold text-xl">
                      {t.name.charAt(0)}
                    </div>
                  )}
                  <div>
                    <div className="font-bold text-white">{t.name}</div>
                    <div className="text-sm text-primary">{t.role}, {t.company}</div>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
      
      <div className="flex items-center justify-center gap-4 mt-8">
        <Button variant="outline" size="icon" className="rounded-full border-white/20 bg-white/5" onClick={scrollPrev}>
          &larr;
        </Button>
        <div className="flex gap-2">
          {testimonials.map((_, idx) => (
            <button
              key={idx}
              className={`w-2 h-2 rounded-full transition-all ${idx === selectedIndex ? "w-6 bg-primary" : "bg-white/20"}`}
              onClick={() => emblaApi?.scrollTo(idx)}
            />
          ))}
        </div>
        <Button variant="outline" size="icon" className="rounded-full border-white/20 bg-white/5" onClick={scrollNext}>
          &rarr;
        </Button>
      </div>
    </div>
  );
}