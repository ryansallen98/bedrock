# Agent mirrors (Cursor ↔ Claude Code)

**Stack hub** (author, tokens, rule/skill tables): root [`CLAUDE.md`](../../CLAUDE.md). **Agent conduct (Boost-style, Bedrock-scoped):** [`AGENTS.md`](../../AGENTS.md).

## Canonical copies (plain files, no symlinks)

| Artifact | Edit here (source) | Mirror (copy) |
|----------|--------------------|---------------|
| Stack rules (`*.mdc`) | **`.cursor/rules/*.mdc`** | **`.claude/rules/*.mdc`** |
| Workflow skills | **`.claude/skills/*/`** | **`.cursor/skills/*/`** |

**`bedrock-sage-bootstrap.md`** is not mirrored to `.cursor/`. Optional per-clone prose (not mirrored): **`site-product.md`**, **`project-memory.md`** — allowed by **`scripts/check-agent-mirrors.sh`**; do not duplicate stack rules there.

## After edits

Run from the repository root:

```bash
./scripts/sync-agent-mirrors.sh
```

That copies rules **Cursor → Claude**, skills **Claude → Cursor**, then runs **`./scripts/check-agent-mirrors.sh`** to confirm parity.

## Drift checks (CI + optional local hook)

- **CI:** `.github/workflows/agent-mirrors.yml` runs `check-agent-mirrors.sh` when `.cursor/`, `.claude/`, or the mirror scripts change.
- **Pre-commit (optional):** enable once per clone:

  ```bash
  git config core.hooksPath scripts/githooks
  ```

  The hook runs **`scripts/check-agent-mirrors.sh`** so commits fail if someone edited only one side of a mirror.

You can always run **`./scripts/check-agent-mirrors.sh`** manually before pushing.

## What the check enforces

- Every **`.cursor/rules/*.mdc`** exists in **`.claude/rules/`** and is **byte-identical**.
- Every **`.claude/rules/*.mdc`** has a counterpart in **`.cursor/rules/`** (no orphan `.mdc` files).
- **`.claude/rules/`** contains `*.mdc` (mirrors of `.cursor/rules/`), **`bedrock-sage-bootstrap.md`**, and optionally **`site-product.md`** / **`project-memory.md`** (product/ops context only).
- **`.cursor/skills/`** and **`.claude/skills/`** match (`diff -rq`).

Do not duplicate long stack prose here — change the owning **`.mdc`** or **`SKILL.md`**, then **sync**.
