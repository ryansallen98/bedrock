#!/usr/bin/env bash
# Keep Cursor ↔ Claude Code agent config identical (plain copies, no symlinks).
# Canonical: stack rules in .cursor/rules/*.mdc; workflow skills in .claude/skills/*/
set -euo pipefail
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

for f in "$ROOT"/.cursor/rules/*.mdc; do
  cp "$f" "$ROOT/.claude/rules/$(basename "$f")"
done

mkdir -p "$ROOT/.cursor/skills"
for src in "$ROOT"/.claude/skills/*; do
  [[ -d "$src" ]] || continue
  name=$(basename "$src")
  rm -rf "$ROOT/.cursor/skills/$name"
  cp -R "$src" "$ROOT/.cursor/skills/$name"
done

echo "sync-agent-mirrors: copied .cursor/rules/*.mdc → .claude/rules/; .claude/skills/* → .cursor/skills/"

"$ROOT/scripts/check-agent-mirrors.sh"
