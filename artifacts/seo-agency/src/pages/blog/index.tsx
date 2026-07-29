import { useListBlogPosts } from "@workspace/api-client-react";
import { Link } from "wouter";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { Clock, Calendar, ArrowRight } from "lucide-react";
import { format } from "date-fns";
import { motion } from "framer-motion";
import { Button } from "@/components/ui/button";

export default function BlogList() {
  const { data: posts, isLoading } = useListBlogPosts();

  return (
    <div className="flex flex-col min-h-screen bg-background">
      {/* Dark Hero */}
      <section className="hero-dark bg-grid-pattern-dark pt-40 pb-24 relative overflow-hidden">
        <div className="container mx-auto px-4 relative z-10 text-center max-w-3xl">
          <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }}>
            <div className="section-label bg-white/10 text-white border-white/20 mb-6">The Growth Log</div>
            <h1 className="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
              Insights & <span className="gradient-text-primary">Intelligence</span>
            </h1>
            <p className="text-xl text-white/80 mb-10 leading-relaxed font-light">
              Expert analysis, algorithm updates, and revenue-driving strategies from our elite team.
            </p>
          </motion.div>
        </div>
      </section>

      {/* Grid (Light Theme) */}
      <section className="py-24 bg-dot-pattern">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {[1, 2, 3, 4, 5, 6].map(i => <Skeleton key={i} className="h-96 rounded-2xl bg-muted" />)}
            </div>
          ) : posts ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {posts.map((post, i) => (
                <motion.div key={post.id} initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ delay: i * 0.1 }}>
                  <Link href={`/blog/${post.slug}`}>
                    <Card className="group h-full bg-white border-border hover:shadow-xl hover:border-primary/30 transition-all duration-300 rounded-2xl overflow-hidden flex flex-col">
                      <div className="aspect-[16/10] relative overflow-hidden bg-muted">
                        {post.featuredImage ? (
                          <img src={post.featuredImage} alt={post.title} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                        ) : (
                          <div className="w-full h-full bg-muted/50 flex items-center justify-center text-muted-foreground">Image</div>
                        )}
                        <div className="absolute top-4 left-4">
                          <span className="px-3 py-1.5 bg-white/90 backdrop-blur text-secondary text-xs font-bold rounded-full uppercase tracking-wider shadow-sm">
                            {post.category}
                          </span>
                        </div>
                      </div>
                      <div className="p-8 flex flex-col flex-1">
                        <div className="flex items-center gap-4 text-xs font-semibold text-muted-foreground mb-4">
                          <span className="flex items-center gap-1.5"><Calendar className="w-3.5 h-3.5" /> {format(new Date(post.publishedAt), 'MMM d, yyyy')}</span>
                          <span className="flex items-center gap-1.5"><Clock className="w-3.5 h-3.5" /> {post.readingTime} min read</span>
                        </div>
                        <h3 className="text-2xl font-bold text-foreground mb-4 group-hover:text-primary transition-colors line-clamp-2 leading-tight">{post.title}</h3>
                        <p className="text-muted-foreground mb-8 flex-1 line-clamp-3 text-base">{post.excerpt}</p>
                        
                        <div className="flex items-center justify-between mt-auto pt-6 border-t border-border">
                          <div className="flex items-center gap-3">
                            {post.authorAvatar ? (
                              <img src={post.authorAvatar} alt={post.author} className="w-9 h-9 rounded-full object-cover" />
                            ) : (
                              <div className="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary text-sm font-bold">
                                {post.author.charAt(0)}
                              </div>
                            )}
                            <div className="text-sm font-bold text-foreground">{post.author}</div>
                          </div>
                          <div className="w-8 h-8 rounded-full bg-muted flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                            <ArrowRight className="w-4 h-4" />
                          </div>
                        </div>
                      </div>
                    </Card>
                  </Link>
                </motion.div>
              ))}
            </div>
          ) : (
            <div className="text-center py-20 text-muted-foreground">No posts found.</div>
          )}
        </div>
      </section>

      {/* Dark CTA */}
      <section className="py-24 hero-dark bg-grid-pattern-dark text-center mt-auto">
        <div className="container mx-auto px-4 max-w-3xl">
          <h2 className="text-4xl font-bold text-white mb-6">Stay Ahead of the Algorithm</h2>
          <p className="text-lg text-white/80 mb-10 font-light">Get the latest SEO strategies delivered straight to your inbox.</p>
          <div className="flex max-w-md mx-auto">
            <input type="email" placeholder="Enter your email" className="h-14 flex-1 px-4 rounded-l-md bg-white text-foreground focus:outline-none" />
            <Button size="lg" className="h-14 rounded-l-none px-8">Subscribe</Button>
          </div>
        </div>
      </section>
    </div>
  );
}