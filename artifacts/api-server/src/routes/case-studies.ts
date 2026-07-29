import { Router, type IRouter } from "express";
import { eq } from "drizzle-orm";
import { db, caseStudiesTable } from "@workspace/db";
import {
  ListCaseStudiesResponse,
  ListCaseStudiesQueryParams,
} from "@workspace/api-zod";

function serializeDates<T extends Record<string, unknown>>(row: T): T {
  return Object.fromEntries(
    Object.entries(row).map(([k, v]) => [k, v instanceof Date ? v.toISOString() : v])
  ) as T;
}

const router: IRouter = Router();

router.get("/case-studies", async (req, res): Promise<void> => {
  const query = ListCaseStudiesQueryParams.safeParse(req.query);
  const service = query.success ? query.data.service : undefined;

  let dbQuery = db.select().from(caseStudiesTable).$dynamic();

  if (service) {
    dbQuery = dbQuery.where(eq(caseStudiesTable.service, service));
  }

  const studies = await dbQuery.orderBy(caseStudiesTable.createdAt);

  res.json(ListCaseStudiesResponse.parse(studies.map(serializeDates)));
});

export default router;
