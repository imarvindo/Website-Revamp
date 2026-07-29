import { motion } from "framer-motion";

const items = [
  "Enterprise SEO",
  "AI Search Optimization",
  "Google Ads Management",
  "Technical SEO Audits",
  "Social Media Marketing",
  "Link Building",
  "Content Strategy",
  "Web Design & Dev",
  "Dubai SEO Agency",
  "UAE Digital Marketing",
  "LLM Optimization",
  "Conversion Rate Optimization",
];

function TickerItem({ text }: { text: string }) {
  return (
    <span className="flex items-center gap-4 shrink-0 px-2">
      <span className="text-sm font-bold uppercase tracking-widest text-white/80 whitespace-nowrap">
        {text}
      </span>
      <span className="w-1.5 h-1.5 rounded-full bg-[#16B1D4] shrink-0" />
    </span>
  );
}

export function MarqueeTicker() {
  const doubled = [...items, ...items];

  return (
    <div
      className="relative overflow-hidden py-4 border-y border-white/10"
      style={{ background: "hsl(233 74% 24%)" }}
    >
      {/* Fade edges */}
      <div className="absolute inset-y-0 left-0 w-16 z-10 pointer-events-none"
        style={{ background: "linear-gradient(to right, hsl(233 74% 24%), transparent)" }} />
      <div className="absolute inset-y-0 right-0 w-16 z-10 pointer-events-none"
        style={{ background: "linear-gradient(to left, hsl(233 74% 24%), transparent)" }} />

      <motion.div
        className="flex"
        animate={{ x: ["0%", "-50%"] }}
        transition={{ duration: 30, ease: "linear", repeat: Infinity }}
      >
        {doubled.map((item, i) => (
          <TickerItem key={i} text={item} />
        ))}
      </motion.div>
    </div>
  );
}
