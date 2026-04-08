<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('integration')]
final class WordPressLoadsTest extends TestCase
{
    public function test_wordpress_core_is_loaded(): void
    {
        self::assertTrue(function_exists('add_action'));
        self::assertTrue(defined('ABSPATH'));
    }
}
