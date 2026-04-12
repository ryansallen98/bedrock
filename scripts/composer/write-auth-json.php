<?php

declare(strict_types=1);

/**
 * Write a local Composer auth.json file from environment-backed premium plugin credentials.
 *
 * Usage:
 *   php scripts/composer/write-auth-json.php
 */

$root = dirname(__DIR__, 2);
$exportScript = $root . '/scripts/composer/export-composer-auth.php';
$authJsonPath = $root . '/auth.json';

$command = sprintf(
    '%s %s',
    escapeshellarg(PHP_BINARY),
    escapeshellarg($exportScript),
);

$output = [];
$exitCode = 0;

exec($command, $output, $exitCode);

if ($exitCode !== 0) {
    fwrite(STDERR, implode(PHP_EOL, $output) . PHP_EOL);
    exit($exitCode);
}

$json = implode(PHP_EOL, $output);
$decoded = json_decode($json, true);

if (! is_array($decoded)) {
    fwrite(STDERR, "write-auth-json: export-composer-auth.php did not return valid JSON.\n");
    exit(1);
}

$prettyJson = json_encode(
    $decoded,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
);

if ($prettyJson === false) {
    fwrite(STDERR, "write-auth-json: failed to encode auth.json payload.\n");
    exit(1);
}

$result = file_put_contents($authJsonPath, $prettyJson . PHP_EOL);

if ($result === false) {
    fwrite(STDERR, "write-auth-json: failed to write {$authJsonPath}.\n");
    exit(1);
}

fwrite(STDOUT, "Wrote {$authJsonPath}\n");
