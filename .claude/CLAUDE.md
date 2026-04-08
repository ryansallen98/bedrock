# Claude Code — project hub

**Stack hub:** repository root [`CLAUDE.md`](../CLAUDE.md) (author, tokens, rules table, skills table).

**Mirrors & sync (single reference):** [`.claude/rules/bedrock-sage-bootstrap.md`](rules/bedrock-sage-bootstrap.md) — canonical paths, `./scripts/sync-agent-mirrors.sh`, `./scripts/check-agent-mirrors.sh`, pre-commit, CI.

## What lives under `.claude/`

| Path | Purpose |
|------|---------|
| **`rules/*.mdc`** | Mirrors of **`.cursor/rules/*.mdc`** — run **`./scripts/sync-agent-mirrors.sh`** after editing the Cursor side. |
| **`rules/bedrock-sage-bootstrap.md`** | Mirror contract only (not in `.cursor/`). |
| **`rules/site-product.md`** | Optional **per-clone** mission/audience (stub until you replace it). |
| **`rules/project-memory.md`** | Optional **per-clone** deploy/IA/paths (stub until you replace it). |
| **`skills/*/`** | Canonical workflow skills — copied to **`.cursor/skills/`** on sync. |
| **`settings.json`** | Shared Claude Code defaults (e.g. Bash allow list). |
| **`settings.local.json`** | Personal overrides — **do not commit** (use **`.gitignore`**). |

## Verify loading (Claude Code)

- **`/memory`** — which `CLAUDE.md` and rules loaded  
- **`/skills`** — available project skills  
- **`/context`** — token breakdown  

## Protocols

Mandatory agent behavior matches **`.cursor/rules/01-global-protocols.mdc`**, **`07-docs-stack-pointers.mdc`**, and root **`AGENTS.md`**.

## MCP

Root **`.mcp.json`** should match **`.cursor/mcp.json`**. Details: **[`docs/mcp.md`](../docs/mcp.md)**.
