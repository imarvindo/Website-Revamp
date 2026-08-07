#!/usr/bin/env bash
# Deploy the premium homepage + service redesign to Hostinger production.
#
# Uploads child-theme redesign files via SSH stdin (scp is unreliable in this jail).
#
# Usage:
#   HOSTINGER_SSH_PASS='...' ./scripts/deploy-redesign-live.sh
#
# Optional overrides:
#   HOSTINGER_SSH_HOST HOSTINGER_SSH_PORT HOSTINGER_SSH_USER HOSTINGER_REMOTE_ROOT

set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
HOST="${HOSTINGER_SSH_HOST:-72.61.230.194}"
PORT="${HOSTINGER_SSH_PORT:-65002}"
USER="${HOSTINGER_SSH_USER:-u635810218_p0262hfDR}"
PASS="${HOSTINGER_SSH_PASS:-${SSHPASS:-}}"
REMOTE_ROOT="${HOSTINGER_REMOTE_ROOT:-/home/u635810218/websites/p0262hfDR/public_html}"
LOCAL_WP="${ROOT}/wordpress"

FILES=(
  "wp-content/themes/seo-ae-child/front-page.php"
  "wp-content/themes/seo-ae-child/single-service.php"
  "wp-content/themes/seo-ae-child/functions.php"
  "wp-content/themes/seo-ae-child/assets/redesign-home.css"
  "wp-content/themes/seo-ae-child/assets/redesign-home.js"
)

if [[ -z "$PASS" ]]; then
  echo "ERROR: Set HOSTINGER_SSH_PASS (or SSHPASS)." >&2
  exit 1
fi
command -v sshpass >/dev/null || { echo "ERROR: sshpass required" >&2; exit 1; }

for f in "${FILES[@]}"; do
  if [[ ! -f "${LOCAL_WP}/${f}" ]]; then
    echo "ERROR: Missing local file: ${LOCAL_WP}/${f}" >&2
    exit 1
  fi
done

export SSHPASS="$PASS"
SSH=(sshpass -e ssh
  -o StrictHostKeyChecking=no
  -o UserKnownHostsFile=/dev/null
  -o ConnectTimeout=25
  -o PreferredAuthentications=password
  -o PubkeyAuthentication=no
  -p "$PORT"
  "${USER}@${HOST}"
)

STAMP="$(date -u +%Y%m%d-%H%M%S)"
BACKUP_DIR="${REMOTE_ROOT}/wp-content/uploads/.deploy-backup-${STAMP}"

echo "==> Connecting as ${USER}@${HOST}:${PORT}"
"${SSH[@]}" "mkdir -p '${REMOTE_ROOT}/wp-content/themes/seo-ae-child/assets' '${BACKUP_DIR}' && printf '%s\n' 'Require all denied' > '${BACKUP_DIR}/.htaccess'"

echo "==> Backing up current remote files → ${BACKUP_DIR}"
for f in "${FILES[@]}"; do
  "${SSH[@]}" "if [ -f '${REMOTE_ROOT}/${f}' ]; then mkdir -p '${BACKUP_DIR}/$(dirname "$f")' && cp '${REMOTE_ROOT}/${f}' '${BACKUP_DIR}/${f}'; fi"
done

echo "==> Uploading redesign files"
for f in "${FILES[@]}"; do
  echo "  - ${f}"
  "${SSH[@]}" "cat > '${REMOTE_ROOT}/${f}'" < "${LOCAL_WP}/${f}"
done

echo "==> Verifying checksums"
LOCAL_SUMS="$(cd "$LOCAL_WP" && md5sum "${FILES[@]}")"
REMOTE_SUMS="$("${SSH[@]}" "cd '${REMOTE_ROOT}' && md5sum ${FILES[*]}")"
echo "$LOCAL_SUMS"
echo "$REMOTE_SUMS"
diff -u <(echo "$LOCAL_SUMS") <(echo "$REMOTE_SUMS") >/dev/null

echo "==> Activating child theme (required for redesign templates)"
"${SSH[@]}" "cd '${REMOTE_ROOT}' && wp theme activate seo-ae-child"

echo "==> Flushing WordPress caches"
"${SSH[@]}" "cd '${REMOTE_ROOT}' && wp cache flush && wp rewrite flush"

echo "==> Done. Redesign deployed."
echo "    Homepage: https://searchengineoptimization.ae/"
echo "    Backup:   ${BACKUP_DIR}"
