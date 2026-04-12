<?php

declare(strict_types=1);

/**
 * Emit COMPOSER_AUTH JSON for ACF Pro downloads.
 *
 * When vendor/ exists, loads the Bedrock .env via Dotenv so local
 * `composer install` can use the same variables as WordPress without manual
 * export.
 *
 * The official install flow authenticates downloads from
 * connect.advancedcustomfields.com using the Composer-generated license token as
 * the username and WP_HOME as the password.
 *
 * Usage:
 *   export COMPOSER_AUTH="$(php scripts/composer/export-composer-auth.php)"
 *   composer install
 */

$root = dirname(__DIR__, 2);
$autoload = $root . '/vendor/autoload.php';

/**
 * Load .env values without requiring Composer dependencies.
 */
function loadPlainEnv(string $path): void
{
    if (! is_readable($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if ($trimmed === '' || str_starts_with($trimmed, '#')) {
            continue;
        }

        $separator = strpos($line, '=');

        if ($separator === false) {
            continue;
        }

        $name = trim(substr($line, 0, $separator));
        $value = trim(substr($line, $separator + 1));

        if ($name === '' || getenv($name) !== false) {
            continue;
        }

        if (
            (str_starts_with($value, "'") && str_ends_with($value, "'"))
            || (str_starts_with($value, '"') && str_ends_with($value, '"'))
        ) {
            $value = substr($value, 1, -1);
        }

        $value = preg_replace_callback(
            '/\$\{([A-Z0-9_]+)\}/',
            static function (array $matches): string {
                return getenv($matches[1]) ?: '';
            },
            $value,
        ) ?? $value;

        putenv("{$name}={$value}");
    }
}

function envValue(string $name): string
{
    $value = getenv($name);

    if ($value !== false && $value !== '') {
        return $value;
    }

    $serverValue = $_ENV[$name] ?? $_SERVER[$name] ?? '';

    return is_string($serverValue) ? $serverValue : '';
}

if (is_readable($autoload)) {
    require $autoload;

    if (class_exists(\Dotenv\Dotenv::class)) {
        \Dotenv\Dotenv::createImmutable($root)->safeLoad();
    }
} else {
    loadPlainEnv($root . '/.env');
}

$payload = ['http-basic' => []];

$acfLicenseKey = envValue('ACF_PRO_LICENSE_KEY');
$acfSiteUrl = envValue('WP_HOME');

if ($acfLicenseKey !== '' && $acfSiteUrl !== '') {
    $payload['http-basic']['connect.advancedcustomfields.com'] = [
        'username' => $acfLicenseKey,
        'password' => $acfSiteUrl,
    ];
}

if ($payload['http-basic'] === []) {
    fwrite(STDERR, "export-composer-auth: no ACF Pro auth values found.\n");
    fwrite(STDERR, "Set ACF_PRO_LICENSE_KEY + WP_HOME.\n");

    exit(1);
}

echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
