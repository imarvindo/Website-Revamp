import { Testimonial } from "@workspace/api-client-react";
import useEmblaCarousel from "embla-carousel-react";
import { Star, Quote, ChevronLeft, ChevronRight } from "lucide-react";
import { useCallback, useEffect, useState } from "react";
import { Button } from "./ui/button";
import { cn } from "@/lib/utils";

export function TestimonialSlider({ testimonials }: { testimonials: Testimonial[] }) {
  const [emblaRef, emblaApi] = useEmblaCarousel({ loop: true, align: "center" });
  const [selectedIndex, setSelectedIndex] = useState(0);

  const scrollPrev = useCallback(() => emblaApi && emblaApi.scrollPrev(), [emblaApi]);
  const scrollNext = useCallback(() => emblaApi && emblaApi.scrollNext(), [emblaApi]);

  const onSelect = useCallback(() => {
    if (!emblaApi) return;
    setSelectedIndex(emblaApi.selectedScrollSnap());
  }, [emblaApi]);

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
              <div className="bg-white border border-border rounded-2xl p-8 md:p-12 relative shadow-sm">
                {/* Decorative quote */}
                <Quote className="absolute top-8 right-8 w-12 h-12 text-primary/10 fill-primary/5" />

                {/* Stars */}
                <div className="flex gap-1 mb-5">
                  {Array.from({ length: 5 }).map((_, i) => (
                    <Star
                      key={i}
                      className={cn(
                        "w-5 h-5",
                        i < t.rating ? "fill-warning text-warning" : "text-border fill-border"
                      )}
                    />
                  ))}
                </div>

                {/* Quote */}
                <p className="text-xl md:text-2xl text-foreground/85 leading-relaxed mb-8 italic font-light">
                  "{t.content}"
                </p>

                {/* Author */}
                <div className="flex items-center gap-4">
                  {t.avatarUrl ? (
                    <img
                      src={t.avatarUrl}
                      alt={t.name}
                      className="w-14 h-14 rounded-full object-cover ring-2 ring-border"
                    />
                  ) : (
                    <div className="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xl ring-2 ring-primary/20">
                      {t.name.charAt(0)}
                    </div>
                  )}
                  <div>
                    <div className="font-bold text-foreground">{t.name}</div>
                    <div className="text-sm text-primary font-medium">{t.role}, {t.company}</div>
                  </div>

                  {/* Verified badge */}
                  <div className="ml-auto hidden sm:flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold border border-green-200">
                    <span className="w-1.5 h-1.5 rounded-full bg-green-500" />
                    Verified Client
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Controls */}
      <div className="flex items-center justify-center gap-4 mt-8">
        <Button
          variant="outline"
          size="icon"
          className="rounded-full border-border hover:border-primary hover:text-primary"
          onClick={scrollPrev}
        >
          <ChevronLeft className="w-4 h-4" />
        </Button>

        {/* Dots */}
        <div className="flex gap-2">
          {testimonials.map((_, idx) => (
            <button
              key={idx}
              onClick={() => emblaApi?.scrollTo(idx)}
              className={cn(
                "rounded-full transition-all duration-300",
                idx === selectedIndex
                  ? "w-6 h-2 bg-primary"
                  : "w-2 h-2 bg-border hover:bg-primary/40"
              )}
              aria-label={`Go to testimonial ${idx + 1}`}
            />
          ))}
        </div>

        <Button
          variant="outline"
          size="icon"
          className="rounded-full border-border hover:border-primary hover:text-primary"
          onClick={scrollNext}
        >
          <ChevronRight className="w-4 h-4" />
        </Button>
      </div>
    </div>
  );
}
