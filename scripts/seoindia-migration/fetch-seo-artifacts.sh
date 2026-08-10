#!/usr/bin/env bash
# fetch-seo-artifacts.sh — download live robots.txt + Yoast sitemaps for backup
set -euo pipefail

ORIGIN="${1:-https://www.seoindia.ai}"
OUT_DIR="${2:-docs/seoindia-ai/seo-artifacts}"
ORIGIN="${ORIGIN%/}"

mkdir -p "$OUT_DIR"
UA="seoindia-migration-fetch/1.0"

echo "Fetching SEO artifacts from ${ORIGIN} → ${OUT_DIR}"

curl -sS -L --max-time 30 -A "$UA" -o "${OUT_DIR}/robots.txt" "${ORIGIN}/robots.txt"
curl -sS -L --max-time 30 -A "$UA" -o "${OUT_DIR}/sitemap_index.xml" "${ORIGIN}/sitemap_index.xml"

while IFS= read -r url; do
  [[ -z "$url" ]] && continue
  name="$(basename "$url")"
  echo "  - $name"
  curl -sS -L --max-time 60 -A "$UA" -o "${OUT_DIR}/${name}" "$url"
done < <(rg -o 'https://[^< ]+-sitemap\.xml' "${OUT_DIR}/sitemap_index.xml" | sort -u)

# Also grab geo sitemap if referenced without -sitemap naming
while IFS= read -r url; do
  [[ -z "$url" ]] && continue
  name="$(basename "$url")"
  [[ -f "${OUT_DIR}/${name}" ]] && continue
  echo "  - $name"
  curl -sS -L --max-time 60 -A "$UA" -o "${OUT_DIR}/${name}" "$url"
done < <(rg -o 'https://[^< ]+sitemap[^< ]*\.xml' "${OUT_DIR}/sitemap_index.xml" | sort -u)

curl -sS -L --max-time 30 -A "$UA" "${ORIGIN}/" \
  | rg -i 'rel=["'\'']canonical["'\'']|name=["'\'']robots["'\'']|<title>|google-site-verification|gtag/js\?id=' \
  > "${OUT_DIR}/homepage-seo-snippets.txt" || true

{
  echo "origin=${ORIGIN}"
  echo "fetched_at_utc=$(date -u +%Y-%m-%dT%H:%MZ)"
  echo "files:"
  ls -1 "$OUT_DIR" | sed 's/^/  - /'
} > "${OUT_DIR}/MANIFEST.txt"

echo "Done. Manifest: ${OUT_DIR}/MANIFEST.txt"
