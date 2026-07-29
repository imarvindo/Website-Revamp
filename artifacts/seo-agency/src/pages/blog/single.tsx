import { useGetBlogPost, getGetBlogPostQueryKey } from "@workspace/api-client-react";
import { useParams, Link } from "wouter";
import { Skeleton } from "@/components/ui/skeleton";
import { Button } from "@/components/ui/button";
import { Clock, Calendar, ChevronLeft, ArrowRight } from "lucide-react";
import { format } from "date-fns";

export default function BlogPost() {
  const { slug } = useParams();
  const { data: post, isLoading } = useGetBlogPost(slug || "", { query: { enabled: !!slug, queryKey: getGetBlogPostQueryKey(slug || "") } });

  if (isLoading) {
    return (
      <div className="pt-40 pb-20 container mx-auto px-4 max-w-3xl">
        <Skeleton className="h-12 w-3/4 mb-6 bg-muted" />
        <Skeleton className="h-6 w-1/4 mb-12 bg-muted" />
        <Skeleton className="h-[400px] w-full rounded-3xl mb-12 bg-muted" />
        <Skeleton className="h-4 w-full mb-4 bg-muted" />
        <Skeleton className="h-4 w-full mb-4 bg-muted" />
        <Skeleton className="h-4 w-2/3 mb-4 bg-muted" />
      </div>
    );
  }

  if (!post) {
    return (
      <div className="pt-40 pb-32 container mx-auto px-4 text-center">
        <h1 className="text-4xl font-bold text-foreground mb-6">Post not found</h1>
        <Link href="/blog"><Button size="lg">Back to Blog</Button></Link>
      </div>
    );
  }

  return (
    <article className="flex flex-col min-h-screen bg-background pt-32">
      {/* Light Theme Body */}
      <div className="container mx-auto px-4 max-w-3xl pb-24">
        <Link href="/blog" className="inline-flex items-center gap-2 text-primary hover:text-primary/80 mb-8 text-sm font-bold uppercase tracking-wider transition-colors">
          <ChevronLeft className="w-4 h-4" /> Back to all articles
        </Link>
        
        <div className="mb-8 flex items-center gap-4">
          <span className="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-wider">
            {post.category}
          </span>
          <div className="flex items-center gap-4 text-sm font-semibold text-muted-foreground">
            <span className="flex items-center gap-1.5"><Calendar className="w-4 h-4" /> {format(new Date(post.publishedAt), 'MMMM d, yyyy')}</span>
            <span className="flex items-center gap-1.5"><Clock className="w-4 h-4" /> {post.readingTime} min read</span>
          </div>
        </div>
        
        <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold text-foreground mb-8 leading-[1.1] tracking-tight">
          {post.title}
        </h1>
        
        <div className="flex items-center gap-4 mb-12 pb-8 border-b border-border">
          {post.authorAvatar ? (
            <img src={post.authorAvatar} alt={post.author} className="w-14 h-14 rounded-full object-cover" />
          ) : (
            <div className="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary text-lg font-bold">
              {post.author.charAt(0)}
            </div>
          )}
          <div>
            <div className="text-lg font-bold text-foreground">{post.author}</div>
            <div className="text-sm text-muted-foreground font-medium">{post.authorRole}</div>
          </div>
        </div>
        
        {post.featuredImage && (
          <div className="mb-16 aspect-video rounded-3xl overflow-hidden border border-border bg-muted shadow-sm">
            <img src={post.featuredImage} alt={post.title} className="w-full h-full object-cover" />
          </div>
        )}
        
        <div 
          className="prose prose-lg prose-p:text-muted-foreground prose-headings:text-foreground prose-a:text-primary hover:prose-a:text-primary/80 prose-strong:text-foreground max-w-none mb-16" 
          dangerouslySetInnerHTML={{ __html: post.content }} 
        />
        
        <div className="pt-8 border-t border-border">
          <div className="flex flex-wrap gap-2">
            {post.tags.map(tag => (
              <span key={tag} className="px-3 py-1 bg-muted text-muted-foreground font-medium text-sm rounded-md">
                #{tag}
              </span>
            ))}
          </div>
        </div>
      </div>

      {/* Dark CTA Bottom */}
      <section className="py-24 hero-dark bg-grid-pattern-dark relative overflow-hidden mt-auto">
        <div className="container mx-auto px-4 text-center max-w-3xl relative z-10">
          <h2 className="text-4xl md:text-5xl font-bold text-white mb-6">Need an SEO Strategy?</h2>
          <p className="text-xl text-white/80 mb-10 font-light">
            Stop reading, start dominating. Let our experts apply these tactics to your business.
          </p>
          <Link href="/contact">
            <Button size="lg" className="h-14 px-10 text-lg gap-2">Get Free Audit <ArrowRight className="w-5 h-5" /></Button>
          </Link>
        </div>
      </section>
    </article>
  );
}