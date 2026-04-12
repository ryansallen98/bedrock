#!/usr/bin/env bash
set -euo pipefail

# Waits until WordPress is installed, then runs scripts/post-deploy.sh once.
# Used by supervisord inside the Docker image (WP-CLI runs as root there).

APP_ROOT="${BEDROCK_APP_ROOT:-/var/www/vhosts/localhost/bedrock}"

cd "$APP_ROOT"

echo "bedrock-post-deploy-when-ready: waiting for WordPress to be installed..."

while true; do
  if wp core is-installed --allow-root --quiet 2>/dev/null; then
    break
  fi
  sleep 5
done

echo "bedrock-post-deploy-when-ready: WordPress is installed; running post-deploy..."
if bash "$APP_ROOT/scripts/post-deploy.sh"; then
  echo "bedrock-post-deploy-when-ready: done."
  exit 0
fi

echo "bedrock-post-deploy-when-ready: post-deploy failed (see logs). Run manually: docker compose exec bedrock sh -lc '$APP_ROOT/scripts/post-deploy.sh'" >&2
exit 0
