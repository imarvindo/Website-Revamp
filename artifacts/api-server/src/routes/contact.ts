import { Router, type IRouter } from "express";
import { db, contactsTable, newsletterTable } from "@workspace/db";
import {
  SubmitContactBody,
  SubmitContactResponse,
  SubscribeNewsletterBody,
  SubscribeNewsletterResponse,
} from "@workspace/api-zod";

const router: IRouter = Router();

router.post("/contact", async (req, res): Promise<void> => {
  const parsed = SubmitContactBody.safeParse(req.body);
  if (!parsed.success) {
    res.status(400).json({ error: parsed.error.message });
    return;
  }

  await db.insert(contactsTable).values(parsed.data);

  res.json(SubmitContactResponse.parse({ success: true, message: "Thank you! We will be in touch within 24 hours." }));
});

router.post("/newsletter", async (req, res): Promise<void> => {
  const parsed = SubscribeNewsletterBody.safeParse(req.body);
  if (!parsed.success) {
    res.status(400).json({ error: parsed.error.message });
    return;
  }

  try {
    await db.insert(newsletterTable).values(parsed.data);
    res.json(SubscribeNewsletterResponse.parse({ success: true, message: "You have been subscribed to our newsletter." }));
  } catch {
    // Duplicate email — already subscribed
    res.json(SubscribeNewsletterResponse.parse({ success: true, message: "You are already subscribed." }));
  }
});

export default router;
