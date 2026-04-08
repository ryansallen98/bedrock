<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Fast suite: no WordPress bootstrap (CI-friendly).
 */
final class ThemeAutoloadTest extends TestCase
{
    public function test_theme_composer_autoload_loads_app_namespace(): void
    {
        self::assertTrue(class_exists(\App\Providers\ThemeServiceProvider::class));
    }
}
