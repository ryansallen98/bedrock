<?php

declare(strict_types=1);

/**
 * Default: Composer autoload only (no DB). Integration tests set WP_INTEGRATION_TESTS=1
 * to load Bedrock / WordPress (requires working .env + database).
 */
if (getenv('WP_INTEGRATION_TESTS') === '1') {
    $bedrockRoot = getenv('BEDROCK_ROOT') ?: dirname(__DIR__, 5);
    $wpLoad = $bedrockRoot.'/web/wp/wp-load.php';

    if (! is_file($wpLoad)) {
        fwrite(STDERR, "tests/bootstrap.php: wp-load not found at {$wpLoad}. Set BEDROCK_ROOT or keep the theme under web/app/themes/{slug}/.\n");
        exit(1);
    }

    require_once $wpLoad;

    return;
}

require dirname(__DIR__).'/vendor/autoload.php';
