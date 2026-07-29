import { Router, type IRouter } from "express";
import { eq } from "drizzle-orm";
import { db, portfolioTable } from "@workspace/db";
import {
  ListPortfolioItemsResponse,
  ListPortfolioItemsQueryParams,
} from "@workspace/api-zod";

function serializeDates<T extends Record<string, unknown>>(row: T): T {
  return Object.fromEntries(
    Object.entries(row).map(([k, v]) => [k, v instanceof Date ? v.toISOString() : v])
  ) as T;
}

const router: IRouter = Router();

router.get("/portfolio", async (req, res): Promise<void> => {
  const query = ListPortfolioItemsQueryParams.safeParse(req.query);
  const category = query.success ? query.data.category : undefined;

  let dbQuery = db.select().from(portfolioTable).$dynamic();

  if (category) {
    dbQuery = dbQuery.where(eq(portfolioTable.category, category));
  }

  const items = await dbQuery.orderBy(portfolioTable.completedAt);

  res.json(ListPortfolioItemsResponse.parse(items.map(serializeDates)));
});

export default router;
