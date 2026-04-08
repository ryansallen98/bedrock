<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SnippetsServiceProvider extends ServiceProvider
{
    /**
     * Load order matches theme rules: security → admin → performance → frontend → integrations.
     *
     * @var list<string>
     */
    private const SNIPPET_CATEGORIES = [
        'security',
        'admin',
        'performance',
        'frontend'
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadSnippets();
    }

    protected function loadSnippets(): void
    {
        $base = app_path('Snippets');

        if (! is_dir($base)) {
            return;
        }

        foreach (self::SNIPPET_CATEGORIES as $category) {
            $dir = $base.DIRECTORY_SEPARATOR.$category;
            if (! is_dir($dir)) {
                continue;
            }
            $this->requirePhpFilesInDirectory($dir);
        }
    }

    /**
     * Require each *.php in the directory, sorted by basename for stable load order.
     */
    protected function requirePhpFilesInDirectory(string $dir): void
    {
        $paths = glob($dir.DIRECTORY_SEPARATOR.'*.php');

        if ($paths === false) {
            return;
        }

        sort($paths, SORT_STRING);

        foreach ($paths as $path) {
            if (is_file($path)) {
                require_once $path;
            }
        }
    }
}
