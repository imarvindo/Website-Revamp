import { Router, type IRouter } from "express";
import healthRouter from "./health";
import blogRouter from "./blog";
import servicesRouter from "./services";
import caseStudiesRouter from "./case-studies";
import testimonialsRouter from "./testimonials";
import portfolioRouter from "./portfolio";
import contactRouter from "./contact";
import statsRouter from "./stats";

const router: IRouter = Router();

router.use(healthRouter);
router.use(blogRouter);
router.use(servicesRouter);
router.use(caseStudiesRouter);
router.use(testimonialsRouter);
router.use(portfolioRouter);
router.use(contactRouter);
router.use(statsRouter);

export default router;
