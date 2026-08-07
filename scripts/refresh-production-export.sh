#!/usr/bin/env bash
# Pull the latest production MySQL export into ./mysql-export.sql
# 1) Triggers private exporter on Hostinger
# 2) Downloads the dump into the repo root
#
# Usage:
#   HOSTINGER_SSH_PASS='...' ./scripts/refresh-production-export.sh
#
# Cron (local/CI):
#   30 3 * * * cd /path/to/Website-Revamp && HOSTINGER_SSH_PASS=... ./scripts/refresh-production-export.sh

set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
OUT="${ROOT}/mysql-export.sql"
HOST="${HOSTINGER_SSH_HOST:-72.61.230.194}"
PORT="${HOSTINGER_SSH_PORT:-65002}"
USER="${HOSTINGER_SSH_USER:-u635810218_p0262hfDR}"
PASS="${HOSTINGER_SSH_PASS:-${SSHPASS:-}}"
REMOTE_EXPORT="${HOSTINGER_EXPORT_PATH:-/home/u635810218/websites/p0262hfDR/public_html/wp-content/private-exports}"

if [[ -z "$PASS" ]]; then
  echo "ERROR: Set HOSTINGER_SSH_PASS (or SSHPASS)." >&2
  exit 1
fi
command -v sshpass >/dev/null || { echo "ERROR: sshpass required" >&2; exit 1; }
export SSHPASS="$PASS"
SSH=(sshpass -e ssh -o StrictHostKeyChecking=no -o PreferredAuthentications=password -o PubkeyAuthentication=no -p "$PORT" "${USER}@${HOST}")

echo "==> Running private exporter on Hostinger"
"${SSH[@]}" "php ${REMOTE_EXPORT}/export-prod.php"

echo "==> Downloading to ${OUT}"
sshpass -e scp -o StrictHostKeyChecking=no -o PreferredAuthentications=password -o PubkeyAuthentication=no -P "$PORT" \
  "${USER}@${HOST}:${REMOTE_EXPORT}/mysql-export-latest.sql" "$OUT"

BYTES=$(wc -c < "$OUT" | tr -d ' ')
echo "==> Done (${BYTES} bytes)"

if [[ "${SEOAE_EXPORT_COMMIT:-0}" == "1" ]]; then
  cd "$ROOT"
  git add mysql-export.sql
  if git diff --cached --quiet; then
    echo "==> No DB changes to commit"
  else
    git commit -m "Refresh production MySQL export ($(date -u +%Y-%m-%d))"
  fi
fi
