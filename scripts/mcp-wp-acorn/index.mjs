#!/usr/bin/env node
/**
 * Stdio MCP server: WP-CLI and Acorn (wp acorn …) from Bedrock root.
 * Requires `wp` on PATH and a working `.env` / DB when commands need WordPress.
 */
import { McpServer } from '@modelcontextprotocol/sdk/server/mcp.js';
import { StdioServerTransport } from '@modelcontextprotocol/sdk/server/stdio.js';
import { spawn } from 'node:child_process';
import * as z from 'zod/v4';

const TIMEOUT_MS = 120_000;

function bedrockRoot() {
  const fromEnv = process.env.BEDROCK_ROOT?.trim();
  if (fromEnv) return fromEnv;
  return process.cwd();
}

function validateArgs(args) {
  if (!Array.isArray(args) || args.length === 0) {
    return 'Provide a non-empty array of string arguments.';
  }
  for (const a of args) {
    if (typeof a !== 'string') return 'Each argument must be a string.';
    if (a.length === 0) return 'Empty string arguments are not allowed.';
    if (/[\r\n\0]/.test(a)) return 'Arguments cannot contain control characters.';
  }
  return null;
}

function runWp(argv) {
  const cwd = bedrockRoot();
  return new Promise((resolve) => {
    const child = spawn('wp', argv, {
      cwd,
      env: { ...process.env },
      shell: false,
      windowsHide: true,
    });

    let stdout = '';
    let stderr = '';
    const timer = setTimeout(() => {
      child.kill('SIGTERM');
      resolve({
        ok: false,
        exitCode: null,
        stdout,
        stderr: `${stderr}\n[bedrock-wp-cli] Command timed out after ${TIMEOUT_MS}ms`,
      });
    }, TIMEOUT_MS);

    child.stdout?.setEncoding('utf8');
    child.stderr?.setEncoding('utf8');
    child.stdout?.on('data', (chunk) => {
      stdout += chunk;
    });
    child.stderr?.on('data', (chunk) => {
      stderr += chunk;
    });

    child.on('error', (err) => {
      clearTimeout(timer);
      resolve({
        ok: false,
        exitCode: null,
        stdout,
        stderr: `${stderr}\n[bedrock-wp-cli] ${err.message}`,
      });
    });

    child.on('close', (code) => {
      clearTimeout(timer);
      resolve({
        ok: code === 0,
        exitCode: code,
        stdout,
        stderr,
      });
    });
  });
}

function formatResult(result) {
  const lines = [
    `exitCode: ${result.exitCode === null ? 'null' : result.exitCode}`,
    `ok: ${result.ok}`,
    '--- stdout ---',
    result.stdout || '(empty)',
    '--- stderr ---',
    result.stderr || '(empty)',
  ];
  return lines.join('\n');
}

const server = new McpServer({
  name: 'bedrock-wp-acorn-cli',
  version: '1.0.0',
});

server.registerTool(
  'wp_cli',
  {
    description:
      'Run WP-CLI from the Bedrock project root (uses wp-cli.yml). Pass each token as a separate string, e.g. ["plugin","list"] or ["core","version"]. Do not use shell metacharacters.',
    inputSchema: {
      args: z
        .array(z.string())
        .min(1)
        .describe('Arguments after `wp`, e.g. ["plugin", "list"]'),
    },
  },
  async ({ args }) => {
    const err = validateArgs(args);
    if (err) {
      return { content: [{ type: 'text', text: err }], isError: true };
    }
    const result = await runWp(args);
    return {
      content: [{ type: 'text', text: formatResult(result) }],
      isError: !result.ok,
    };
  },
);

server.registerTool(
  'wp_acorn',
  {
    description:
      'Run Roots Acorn console via `wp acorn …` from the Bedrock root. Pass only the tokens after `acorn`, e.g. ["list"] or ["optimize:clear"] or ["view:cache"]. Use [] to run `wp acorn` alone (help).',
    inputSchema: {
      args: z
        .array(z.string())
        .describe(
          'Arguments after `wp acorn`, e.g. ["list"] or [].',
        ),
    },
  },
  async ({ args }) => {
    const acornArgs = Array.isArray(args) ? args : [];
    const full = ['acorn', ...acornArgs];
    const v = validateArgs(full);
    if (v) {
      return { content: [{ type: 'text', text: v }], isError: true };
    }
    const result = await runWp(full);
    return {
      content: [{ type: 'text', text: formatResult(result) }],
      isError: !result.ok,
    };
  },
);

async function main() {
  const transport = new StdioServerTransport();
  await server.connect(transport);
}

main().catch((error) => {
  console.error('[bedrock-wp-cli]', error);
  process.exit(1);
});