import { useListBlogPosts } from "@workspace/api-client-react";
import { Link } from "wouter";
import { Card } from "@/components/ui/card";
import { Skeleton } from "@/components/ui/skeleton";
import { Clock, Calendar } from "lucide-react";
import { format } from "date-fns";

export default function BlogList() {
  const { data: posts, isLoading } = useListBlogPosts();

  return (
    <div className="flex flex-col min-h-screen">
      <section className="pt-40 pb-20 relative overflow-hidden bg-secondary/30">
        <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px]" />
        
        <div className="container mx-auto px-4 relative z-10 text-center max-w-3xl">
          <h1 className="text-5xl md:text-6xl font-extrabold text-white mb-6">
            Insights & <span className="text-primary">Intelligence</span>
          </h1>
          <p className="text-xl text-white/70 mb-10 leading-relaxed">
            Expert analysis, algorithm updates, and growth strategies from our elite team.
          </p>
        </div>
      </section>

      <section className="py-24">
        <div className="container mx-auto px-4">
          {isLoading ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {[1, 2, 3, 4, 5, 6].map(i => <Skeleton key={i} className="h-96 rounded-2xl" />)}
            </div>
          ) : posts ? (
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {posts.map((post) => (
                <Link key={post.id} href={`/blog/${post.slug}`}>
                  <Card className="group h-full hover:bg-white/5 transition-all duration-300 border-white/10 hover:border-primary/50 relative overflow-hidden flex flex-col">
                    <div className="aspect-video relative overflow-hidden bg-white/5">
                      {post.featuredImage ? (
                        <img src={post.featuredImage} alt={post.title} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                      ) : (
                        <div className="w-full h-full bg-gradient-to-br from-secondary to-background" />
                      )}
                      <div className="absolute top-4 left-4">
                        <span className="px-3 py-1 bg-black/60 backdrop-blur text-white text-xs font-bold rounded-full uppercase tracking-wider">
                          {post.category}
                        </span>
                      </div>
                    </div>
                    <div className="p-6 flex flex-col flex-1">
                      <div className="flex items-center gap-4 text-xs text-white/50 mb-4">
                        <span className="flex items-center gap-1"><Calendar className="w-3 h-3" /> {format(new Date(post.publishedAt), 'MMM d, yyyy')}</span>
                        <span className="flex items-center gap-1"><Clock className="w-3 h-3" /> {post.readingTime} min read</span>
                      </div>
                      <h3 className="text-xl font-bold text-white mb-3 group-hover:text-primary transition-colors line-clamp-2">{post.title}</h3>
                      <p className="text-white/60 mb-6 flex-1 line-clamp-3">{post.excerpt}</p>
                      
                      <div className="flex items-center gap-3 mt-auto pt-4 border-t border-white/10">
                        {post.authorAvatar ? (
                          <img src={post.authorAvatar} alt={post.author} className="w-8 h-8 rounded-full" />
                        ) : (
                          <div className="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary text-xs font-bold">
                            {post.author.charAt(0)}
                          </div>
                        )}
                        <div>
                          <div className="text-sm font-medium text-white">{post.author}</div>
                        </div>
                      </div>
                    </div>
                  </Card>
                </Link>
              ))}
            </div>
          ) : (
            <div className="text-center py-20 text-white/50">No posts found.</div>
          )}
        </div>
      </section>
    </div>
  );
}