# MCP (Model Context Protocol)

Keep **`.cursor/mcp.json`** and **`.mcp.json`** (repo root) **identical** when you edit either.

## Servers in this repo

| Server | Role |
|--------|------|
| **bedrock-wp-acorn-cli** | Stdio: run **`wp`** and **`wp acorn`** from Bedrock root (`wp-cli.yml`). See below. |
| **context7** | Library docs lookup (`npx @upstash/context7-mcp`). Optional **`CONTEXT7_API_KEY`**. |
| **playwright** | Browser automation MCP (`npx @playwright/mcp`). |
| **github** | GitHub API (`dotenv-cli` loads **`.env`** for tokens — do not commit secrets). |
| **perplexity** | Web-grounded Q&A (`@perplexity-ai/mcp-server`). Set **`PERPLEXITY_API_KEY`** if required. |

Enable only the servers you need in Cursor / Claude Code settings to avoid slow startup or missing keys.

---

## Bedrock WP-CLI + Acorn (stdio)

Runs [WP-CLI](https://wp-cli.org/) from the **Bedrock root** so project **`wp-cli.yml`** applies (`path: web/wp`, `server.docroot: web`).

| Tool | Maps to | Example `args` |
|------|---------|----------------|
| `wp_cli` | `wp …` | `["plugin", "list"]` |
| `wp_acorn` | `wp acorn …` | `["list"]`, `["optimize:clear"]` |

### Setup

1. **WP-CLI** on your PATH (`wp` must run in a normal terminal from the repo root).
2. **Dependencies** for the stdio server (once per clone):

   ```bash
   cd scripts/mcp-wp-acorn && npm ci
   ```

3. **Cursor:** workspace MCP is **`.cursor/mcp.json`**. Enable **bedrock-wp-acorn-cli** if it does not auto-load.
4. **Environment:** `BEDROCK_ROOT` is set to `${workspaceFolder}` in config so the server resolves the project even if the process cwd differs.

### Safety

**wp_cli** / **wp_acorn** can run destructive WP-CLI commands. Treat like shell access: use tool approvals, and avoid on production unless intended.

### Root vs theme

WP-CLI and Acorn run from **Bedrock root**, not `web/app/themes/sage/`. Theme assets: **`npm`** in the theme directory.

---

### Align copies

**`.cursor/mcp.json`** ↔ **`.mcp.json`** per **`.cursor/rules/07-docs-stack-pointers.mdc`**.
