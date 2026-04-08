#!/usr/bin/env bash
# Fail if .cursor rules/skills and .claude mirrors disagree (run in CI and pre-commit).
# Allowed extras under .claude/rules/: bedrock-sage-bootstrap.md, optional per-clone site-product.md / project-memory.md.
set -euo pipefail
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
ERR=0

check_rules() {
  local f b
  shopt -s nullglob
  for f in "$ROOT/.cursor/rules"/*.mdc; do
    b=$(basename "$f")
    if [[ ! -f "$ROOT/.claude/rules/$b" ]]; then
      echo "check-agent-mirrors: missing .claude/rules/$b (run ./scripts/sync-agent-mirrors.sh)" >&2
      ERR=1
      continue
    fi
    if ! diff -q "$f" "$ROOT/.claude/rules/$b" >/dev/null; then
      echo "check-agent-mirrors: drift between .cursor/rules/$b and .claude/rules/$b" >&2
      ERR=1
    fi
  done

  for f in "$ROOT/.claude/rules"/*.mdc; do
    b=$(basename "$f")
    if [[ ! -f "$ROOT/.cursor/rules/$b" ]]; then
      echo "check-agent-mirrors: orphan .claude/rules/$b (no counterpart in .cursor/rules/)" >&2
      ERR=1
    fi
  done

  for f in "$ROOT/.claude/rules"/*; do
    [[ -e "$f" ]] || continue
    b=$(basename "$f")
    case "$b" in
      *.mdc | bedrock-sage-bootstrap.md | site-product.md | project-memory.md) ;;
      *)
        echo "check-agent-mirrors: unexpected file in .claude/rules/: $b" >&2
        ERR=1
        ;;
    esac
  done
  shopt -u nullglob
}

check_skills() {
  if [[ ! -d "$ROOT/.claude/skills" ]]; then
    echo "check-agent-mirrors: missing .claude/skills/" >&2
    ERR=1
    return
  fi
  mkdir -p "$ROOT/.cursor/skills"
  if ! diff -rq "$ROOT/.cursor/skills" "$ROOT/.claude/skills" >/dev/null; then
    echo "check-agent-mirrors: drift between .cursor/skills/ and .claude/skills/ (run ./scripts/sync-agent-mirrors.sh)" >&2
    diff -rq "$ROOT/.cursor/skills" "$ROOT/.claude/skills" >&2 || true
    ERR=1
  fi
}

check_rules
check_skills

if [[ "$ERR" -ne 0 ]]; then
  echo "check-agent-mirrors: failed — fix mirrors then commit (see .claude/rules/bedrock-sage-bootstrap.md)" >&2
  exit 1
fi

echo "check-agent-mirrors: OK (.cursor/rules ↔ .claude/rules .mdc; optional .md stubs allowed; skills trees match)"
