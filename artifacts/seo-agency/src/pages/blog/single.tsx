import { useGetBlogPost, getGetBlogPostQueryKey } from "@workspace/api-client-react";
import { useParams, Link } from "wouter";
import { Skeleton } from "@/components/ui/skeleton";
import { Button } from "@/components/ui/button";
import { Clock, Calendar, ChevronLeft } from "lucide-react";
import { format } from "date-fns";

export default function BlogPost() {
  const { slug } = useParams();
  const { data: post, isLoading } = useGetBlogPost(slug || "", { query: { enabled: !!slug, queryKey: getGetBlogPostQueryKey(slug || "") } });

  if (isLoading) {
    return (
      <div className="pt-40 pb-20 container mx-auto px-4 max-w-3xl">
        <Skeleton className="h-10 w-3/4 mb-6" />
        <Skeleton className="h-6 w-1/4 mb-12" />
        <Skeleton className="h-[400px] w-full rounded-2xl mb-12" />
        <Skeleton className="h-4 w-full mb-4" />
        <Skeleton className="h-4 w-full mb-4" />
        <Skeleton className="h-4 w-2/3 mb-4" />
      </div>
    );
  }

  if (!post) {
    return (
      <div className="pt-40 pb-20 container mx-auto px-4 text-center">
        <h1 className="text-3xl font-bold text-white mb-4">Post not found</h1>
        <Link href="/blog"><Button>Back to Blog</Button></Link>
      </div>
    );
  }

  return (
    <article className="flex flex-col min-h-screen pt-32 pb-24">
      <div className="container mx-auto px-4 max-w-3xl">
        <Link href="/blog" className="inline-flex items-center gap-2 text-primary hover:text-primary/80 mb-8 text-sm font-medium transition-colors">
          <ChevronLeft className="w-4 h-4" /> Back to all articles
        </Link>
        
        <div className="mb-8 flex items-center gap-4">
          <span className="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-wider">
            {post.category}
          </span>
          <div className="flex items-center gap-4 text-sm text-white/50">
            <span className="flex items-center gap-1.5"><Calendar className="w-4 h-4" /> {format(new Date(post.publishedAt), 'MMMM d, yyyy')}</span>
            <span className="flex items-center gap-1.5"><Clock className="w-4 h-4" /> {post.readingTime} min read</span>
          </div>
        </div>
        
        <h1 className="text-4xl md:text-5xl font-extrabold text-white mb-8 leading-tight">
          {post.title}
        </h1>
        
        <div className="flex items-center gap-4 mb-12 pb-8 border-b border-white/10">
          {post.authorAvatar ? (
            <img src={post.authorAvatar} alt={post.author} className="w-12 h-12 rounded-full" />
          ) : (
            <div className="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center text-primary text-lg font-bold">
              {post.author.charAt(0)}
            </div>
          )}
          <div>
            <div className="text-base font-bold text-white">{post.author}</div>
            <div className="text-sm text-white/50">{post.authorRole}</div>
          </div>
        </div>
        
        {post.featuredImage && (
          <div className="mb-16 aspect-video rounded-2xl overflow-hidden border border-white/10 bg-white/5">
            <img src={post.featuredImage} alt={post.title} className="w-full h-full object-cover" />
          </div>
        )}
        
        <div className="prose prose-invert prose-lg prose-p:text-white/70 prose-headings:text-white prose-a:text-primary hover:prose-a:text-primary/80 max-w-none mb-16" dangerouslySetInnerHTML={{ __html: post.content }} />
        
        <div className="pt-8 border-t border-white/10">
          <div className="flex flex-wrap gap-2">
            {post.tags.map(tag => (
              <span key={tag} className="px-3 py-1 bg-white/5 text-white/60 text-sm rounded-md">
                #{tag}
              </span>
            ))}
          </div>
        </div>
      </div>
    </article>
  );
}