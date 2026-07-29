import { Router, type IRouter } from "express";
import { eq } from "drizzle-orm";
import { db, blogPostsTable } from "@workspace/db";
import {
  ListBlogPostsResponse,
  GetBlogPostResponse,
  GetBlogPostParams,
  ListBlogPostsQueryParams,
} from "@workspace/api-zod";

// Drizzle returns Date objects; OpenAPI spec declares timestamps as strings
function serializeDates<T extends Record<string, unknown>>(row: T): T {
  return Object.fromEntries(
    Object.entries(row).map(([k, v]) => [k, v instanceof Date ? v.toISOString() : v])
  ) as T;
}

const router: IRouter = Router();

router.get("/blog-posts", async (req, res): Promise<void> => {
  const query = ListBlogPostsQueryParams.safeParse(req.query);
  const category = query.success ? query.data.category : undefined;
  const limit = query.success ? query.data.limit : undefined;
  const offset = query.success ? query.data.offset : undefined;

  let dbQuery = db.select().from(blogPostsTable).$dynamic();

  if (category) {
    dbQuery = dbQuery.where(eq(blogPostsTable.category, category));
  }

  const posts = await dbQuery
    .orderBy(blogPostsTable.publishedAt)
    .limit(limit ?? 20)
    .offset(offset ?? 0);

  res.json(ListBlogPostsResponse.parse(posts.map(serializeDates)));
});

router.get("/blog-posts/:slug", async (req, res): Promise<void> => {
  const params = GetBlogPostParams.safeParse(req.params);
  if (!params.success) {
    res.status(400).json({ error: params.error.message });
    return;
  }

  const [post] = await db
    .select()
    .from(blogPostsTable)
    .where(eq(blogPostsTable.slug, params.data.slug));

  if (!post) {
    res.status(404).json({ error: "Blog post not found" });
    return;
  }

  res.json(GetBlogPostResponse.parse(serializeDates(post)));
});

export default router;
