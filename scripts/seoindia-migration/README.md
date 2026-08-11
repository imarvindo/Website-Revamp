# seoindia.ai migration helpers

Companion scripts for [`docs/seoindia-ai/HOSTING-MIGRATION.md`](../../docs/seoindia-ai/HOSTING-MIGRATION.md).

## Backup live SEO artifacts

```bash
./scripts/seoindia-migration/fetch-seo-artifacts.sh \
  https://www.seoindia.ai \
  docs/seoindia-ai/seo-artifacts
```

## Verify staging (blocked from Google)

```bash
./scripts/seoindia-migration/verify-site.sh \
  --base https://staging.seoindia.ai \
  --urls docs/seoindia-ai/urls.txt \
  --expect-noindex \
  --auth 'user:pass' \
  --report artifacts/seoindia-staging-report.md
```

## Verify production after DNS switch

```bash
./scripts/seoindia-migration/verify-site.sh \
  --base https://www.seoindia.ai \
  --urls docs/seoindia-ai/urls.txt \
  --expect-indexable \
  --report artifacts/seoindia-prod-report.md
```

Exit code `1` means one or more FAIL checks; WARN does not fail the run.
