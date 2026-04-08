<?php

/**
 * Theme root: block.php — ACFE / ACF block render callback.
 *
 * Resolves `blocks.{slug}` → resources/views/blocks/{slug}.blade.php (underscore slugs, same convention as flexible).
 * See .cursor/rules/12-acf-blocks.mdc and skill acf-blocks.
 */
if (! empty($block['name'])) {

    $slug = str_replace('acf/', '', $block['name']);
    $view_name = "blocks.$slug";

    if (function_exists('\Roots\view')) {
        if (\Roots\view()->exists($view_name)) {
            echo \Roots\view($view_name, [
                'block' => $block,
                'post_id' => $post_id ?? null,
                'is_preview' => $is_preview ?? false,
            ])->render();
        } else {
            echo "<!-- Block view not found: {$view_name} -->";
        }
    } else {
        echo "<!-- Blade not loaded and no PHP fallback for {$view_name} -->";
    }

}
