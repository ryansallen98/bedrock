<?php

declare(strict_types=1);

namespace App\View\Components\Button;

use TailwindMerge\TailwindMerge;

final class ButtonClasses
{
    public static function merge(
        TailwindMerge $tw,
        string $variant,
        string $size,
        ?string $attributesClass,
        bool $iconSizes = false,
    ): string {
        /** @var array{root: array{base: string, variants: array<string, string>, sizes: array<string, string>}, icon: array{sizes: array<string, string>}} $config */
        $config = config('components.button');
        $root = $config['root'];
        $sizes = $iconSizes ? $config['icon']['sizes'] : $root['sizes'];

        return $tw->merge(
            $root['base'],
            $root['variants'][$variant] ?? $root['variants']['default'],
            $sizes[$size] ?? $sizes['default'],
            $attributesClass ?? '',
        );
    }
}
