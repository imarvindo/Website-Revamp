#!/usr/bin/env bash
# verify-site.sh — SEO-safe migration checks for seoindia.ai (staging or production)
set -euo pipefail

BASE=""
URLS_FILE=""
REPORT=""
EXPECT_NOINDEX=0
EXPECT_INDEXABLE=0
AUTH_USER=""
AUTH_PASS=""
TIMEOUT=20
USER_AGENT="seoindia-migration-verify/1.0"

usage() {
  cat <<'EOF'
Usage:
  verify-site.sh --base https://HOST --urls docs/seoindia-ai/urls.txt [options]

Options:
  --base URL            Staging or production origin (required)
  --urls FILE           Flat URL list using https://www.seoindia.ai/... paths (required)
  --report FILE         Write Markdown report (optional)
  --expect-noindex      Staging mode: fail if public HTML is missing noindex
  --expect-indexable    Production mode: fail if robots/noindex block indexing
  --auth USER:PASS      Optional HTTP basic auth for staging
  --timeout SECONDS     curl timeout (default: 20)
  -h, --help            Show help
EOF
}

while [[ $# -gt 0 ]]; do
  case "$1" in
    --base) BASE="${2:-}"; shift 2 ;;
    --urls) URLS_FILE="${2:-}"; shift 2 ;;
    --report) REPORT="${2:-}"; shift 2 ;;
    --expect-noindex) EXPECT_NOINDEX=1; shift ;;
    --expect-indexable) EXPECT_INDEXABLE=1; shift ;;
    --auth)
      AUTH_USER="${2%%:*}"
      AUTH_PASS="${2#*:}"
      shift 2
      ;;
    --timeout) TIMEOUT="${2:-}"; shift 2 ;;
    -h|--help) usage; exit 0 ;;
    *) echo "Unknown option: $1" >&2; usage >&2; exit 2 ;;
  esac
done

if [[ -z "$BASE" || -z "$URLS_FILE" ]]; then
  usage >&2
  exit 2
fi
if [[ ! -f "$URLS_FILE" ]]; then
  echo "URLs file not found: $URLS_FILE" >&2
  exit 2
fi
if [[ "$EXPECT_NOINDEX" -eq 1 && "$EXPECT_INDEXABLE" -eq 1 ]]; then
  echo "Choose only one of --expect-noindex or --expect-indexable" >&2
  exit 2
fi

BASE="${BASE%/}"
PROD_ORIGIN="https://www.seoindia.ai"
TMP_DIR="$(mktemp -d)"
trap 'rm -rf "$TMP_DIR"' EXIT

CURL_AUTH=()
if [[ -n "$AUTH_USER" ]]; then
  CURL_AUTH=(-u "${AUTH_USER}:${AUTH_PASS}")
fi

curl_common=(
  -sS
  -L
  --max-time "$TIMEOUT"
  -A "$USER_AGENT"
  "${CURL_AUTH[@]}"
)

map_url() {
  local src="$1"
  # Preserve path/query when rewriting production inventory URLs onto --base
  local path="${src#"$PROD_ORIGIN"}"
  if [[ "$path" == "$src" ]]; then
    # Also accept apex inventory URLs
    path="${src#https://seoindia.ai}"
  fi
  if [[ "$path" == "$src" ]]; then
    echo "$src"
  else
    echo "${BASE}${path}"
  fi
}

pass=0
fail=0
warn=0
ROWS=()

note() {
  local level="$1"; shift
  ROWS+=("| ${level} | $* |")
  case "$level" in
    PASS) pass=$((pass + 1)) ;;
    FAIL) fail=$((fail + 1)) ;;
    WARN) warn=$((warn + 1)) ;;
  esac
}

echo "Checking site: $BASE"
echo "URL list: $URLS_FILE"
echo

# --- robots.txt ---
ROBOTS_URL="${BASE}/robots.txt"
ROBOTS_BODY="$TMP_DIR/robots.txt"
ROBOTS_CODE="$(curl "${curl_common[@]}" -o "$ROBOTS_BODY" -w '%{http_code}' "$ROBOTS_URL" || true)"
if [[ "$ROBOTS_CODE" != "200" ]]; then
  note FAIL "robots.txt HTTP ${ROBOTS_CODE} at ${ROBOTS_URL}"
else
  note PASS "robots.txt HTTP 200"
  if [[ "$EXPECT_NOINDEX" -eq 1 ]]; then
    if rg -q -i '^\s*Disallow:\s*/\s*$' "$ROBOTS_BODY"; then
      note PASS "staging robots.txt disallows all"
    else
      note WARN "staging robots.txt does not Disallow: / (rely on auth/noindex)"
    fi
  fi
  if [[ "$EXPECT_INDEXABLE" -eq 1 ]]; then
    if rg -q -i '^\s*Disallow:\s*/\s*$' "$ROBOTS_BODY"; then
      note FAIL "production robots.txt blocks entire site"
    else
      note PASS "production robots.txt is not fully disallowing"
    fi
    if rg -q -i 'Sitemap:\s*https://www\.seoindia\.ai/' "$ROBOTS_BODY"; then
      note PASS "robots.txt sitemap points at www.seoindia.ai"
    else
      note FAIL "robots.txt missing production sitemap URL"
    fi
  fi
fi

# --- homepage SEO signals ---
HOME_BODY="$TMP_DIR/home.html"
HOME_HEADERS="$TMP_DIR/home.headers"
HOME_CODE="$(curl "${curl_common[@]}" -D "$HOME_HEADERS" -o "$HOME_BODY" -w '%{http_code}' "${BASE}/" || true)"
if [[ "$HOME_CODE" != "200" ]]; then
  note FAIL "homepage HTTP ${HOME_CODE}"
else
  note PASS "homepage HTTP 200"
fi

if rg -q -i 'name=["'\'']robots["'\''][^>]*noindex|content=["'\''][^"'\'']*noindex' "$HOME_BODY"; then
  if [[ "$EXPECT_NOINDEX" -eq 1 ]]; then
    note PASS "homepage has noindex (staging)"
  elif [[ "$EXPECT_INDEXABLE" -eq 1 ]]; then
    note FAIL "homepage has noindex on production"
  else
    note WARN "homepage has noindex meta"
  fi
else
  if [[ "$EXPECT_NOINDEX" -eq 1 ]]; then
    note WARN "homepage missing noindex (ensure HTTP auth or robots Disallow)"
  elif [[ "$EXPECT_INDEXABLE" -eq 1 ]]; then
    note PASS "homepage is indexable (no noindex meta)"
  else
    note PASS "homepage has no noindex meta"
  fi
fi

CANONICAL="$(rg -o -i 'rel=["'\'']canonical["'\''][^>]*href=["'\''][^"'\'']+|href=["'\''][^"'\'']+["'\''][^>]*rel=["'\'']canonical["'\'']' "$HOME_BODY" | head -1 || true)"
if [[ -n "$CANONICAL" ]]; then
  note PASS "homepage canonical present"
  if [[ "$EXPECT_INDEXABLE" -eq 1 ]]; then
    if rg -q 'https://www\.seoindia\.ai/?' <<<"$CANONICAL"; then
      note PASS "homepage canonical uses www.seoindia.ai"
    else
      note FAIL "homepage canonical is not https://www.seoindia.ai/ (${CANONICAL})"
    fi
  fi
else
  note FAIL "homepage canonical missing"
fi

if rg -q -i 'application/ld\+json|yoast-schema-graph' "$HOME_BODY"; then
  note PASS "JSON-LD / Yoast schema present on homepage"
else
  note WARN "no JSON-LD / Yoast schema detected on homepage"
fi

# --- sitemap ---
SITEMAP_URL="${BASE}/sitemap_index.xml"
SITEMAP_CODE="$(curl "${curl_common[@]}" -o "$TMP_DIR/sitemap.xml" -w '%{http_code}' "$SITEMAP_URL" || true)"
if [[ "$SITEMAP_CODE" == "200" ]] && rg -q '<sitemapindex|<urlset' "$TMP_DIR/sitemap.xml"; then
  note PASS "sitemap_index.xml reachable"
else
  # Yoast sometimes only on /sitemap_index.xml; also try plain /sitemap.xml
  SITEMAP_CODE2="$(curl "${curl_common[@]}" -o "$TMP_DIR/sitemap2.xml" -w '%{http_code}' "${BASE}/sitemap.xml" || true)"
  if [[ "$SITEMAP_CODE2" == "200" ]]; then
    note PASS "sitemap.xml reachable"
  else
    note FAIL "sitemap not reachable (${SITEMAP_CODE} / ${SITEMAP_CODE2})"
  fi
fi

# --- URL inventory ---
echo "Checking inventory URLs..."
while IFS= read -r line || [[ -n "$line" ]]; do
  [[ -z "$line" || "$line" =~ ^# ]] && continue
  target="$(map_url "$line")"
  code="$(curl "${curl_common[@]}" -o /dev/null -w '%{http_code}' "$target" || true)"
  if [[ "$code" == "200" ]]; then
    note PASS "HTTP 200 ${target}"
  elif [[ "$code" == "301" || "$code" == "302" ]]; then
    # With -L this is uncommon; treat as warn if somehow not followed
    note WARN "HTTP ${code} ${target}"
  else
    note FAIL "HTTP ${code} ${target}"
  fi
done < "$URLS_FILE"

# --- apex check when verifying production ---
if [[ "$EXPECT_INDEXABLE" -eq 1 ]]; then
  APEX_HEADERS="$TMP_DIR/apex.headers"
  APEX_CODE="$(curl -sS --max-time "$TIMEOUT" -A "$USER_AGENT" -o /dev/null -D "$APEX_HEADERS" -w '%{http_code}' "https://seoindia.ai/" || true)"
  APEX_LOC="$(rg -i '^location:' "$APEX_HEADERS" | head -1 | tr -d '\r' || true)"
  if [[ "$APEX_CODE" =~ ^30[1237]$ ]] && rg -q 'www\.seoindia\.ai' <<<"$APEX_LOC"; then
    note PASS "apex seoindia.ai redirects to www (${APEX_CODE})"
  else
    note WARN "apex redirect check: HTTP ${APEX_CODE} ${APEX_LOC}"
  fi
fi

echo
echo "Summary: PASS=${pass} WARN=${warn} FAIL=${fail}"

if [[ -n "$REPORT" ]]; then
  mkdir -p "$(dirname "$REPORT")"
  {
    echo "# seoindia.ai verification report"
    echo
    echo "- Target: \`${BASE}\`"
    echo "- Generated: $(date -u +%Y-%m-%dT%H:%MZ)"
    echo "- PASS: ${pass}"
    echo "- WARN: ${warn}"
    echo "- FAIL: ${fail}"
    echo
    echo "| Result | Detail |"
    echo "|---|---|"
    printf '%s\n' "${ROWS[@]}"
  } > "$REPORT"
  echo "Wrote report: $REPORT"
fi

if [[ "$fail" -gt 0 ]]; then
  exit 1
fi
exit 0
