import { Router, type IRouter } from "express";
import { db, blogPostsTable, caseStudiesTable, testimonialsTable } from "@workspace/db";
import {
  GetAgencyStatsResponse,
  GetFeaturedContentResponse,
} from "@workspace/api-zod";
import { desc } from "drizzle-orm";

function serializeDates<T extends Record<string, unknown>>(row: T): T {
  return Object.fromEntries(
    Object.entries(row).map(([k, v]) => [k, v instanceof Date ? v.toISOString() : v])
  ) as T;
}

const router: IRouter = Router();

router.get("/stats", async (_req, res): Promise<void> => {
  const stats = {
    clientsServed: 320,
    projectsCompleted: 840,
    yearsExperience: 8,
    countriesReached: 22,
    averageRoiIncrease: 340,
    googleRating: 4.9,
    totalReviews: 127,
  };

  res.json(GetAgencyStatsResponse.parse(stats));
});

router.get("/featured", async (_req, res): Promise<void> => {
  const [blogPosts, caseStudies, testimonials] = await Promise.all([
    db.select().from(blogPostsTable).orderBy(desc(blogPostsTable.publishedAt)).limit(3),
    db.select().from(caseStudiesTable).orderBy(desc(caseStudiesTable.createdAt)).limit(3),
    db.select().from(testimonialsTable).orderBy(desc(testimonialsTable.createdAt)).limit(6),
  ]);

  res.json(GetFeaturedContentResponse.parse({
    blogPosts: blogPosts.map(serializeDates),
    caseStudies: caseStudies.map(serializeDates),
    testimonials: testimonials.map(serializeDates),
  }));
});

export default router;
