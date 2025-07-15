<?php

declare(strict_types=1);

use RainbowRush\KaraTemplater\Core\Line;

function expr(string $expression): string
{
    return "!{$expression}!";
}

function color(string ...$colors): string
{
    $converted = [];

    foreach ($colors as $color) {
        if (str_starts_with($color, '&H') && str_ends_with($color, '&')) {
            $converted[] = strtoupper($color);
            continue;
        }

        if (preg_match('/^#([a-fA-F0-9]{3})$/', $color, $m)) {
            $shortHex = $m[1];
            $r = str_repeat($shortHex[0], 2);
            $g = str_repeat($shortHex[1], 2);
            $b = str_repeat($shortHex[2], 2);
        } elseif (preg_match('/^#([a-fA-F0-9]{6})$/', $color, $m)) {
            $hex = $m[1];
            $r = substr($hex, 0, 2);
            $g = substr($hex, 2, 2);
            $b = substr($hex, 4, 2);
        } else {
            $converted[] = $color;
            continue;
        }

        $converted[] = sprintf('&H%s%s%s&', strtoupper($b), strtoupper($g), strtoupper($r));
    }

    return implode(',', $converted);
}

function section(string $label, string $content): ?string
{
    $emptyLine = Line::comment()->content('');

    if ('' === $content || '0' === $content) {
        return null;
    }

    $padding = 10;
    $textLine = Line::comment()->content('[ '.str_repeat('=', $padding).' '.$label.' '.str_repeat('=', $padding).' ]');

    return $textLine.\PHP_EOL.$emptyLine.\PHP_EOL.$content.\PHP_EOL.$emptyLine;
}

function minify_lua(string $code): string
{
    $code = preg_replace('/--\[\[(.|\s)*?\]\]/', '', $code);

    $code = preg_replace('/--[^\r\n]*/', '', (string) $code);

    $lines = explode("\n", (string) $code);

    $minified = [];

    foreach ($lines as $line) {
        $trimmed = trim($line);
        if ('' !== $trimmed) {
            $minified[] = $trimmed;
        }
    }

    return implode(' ', $minified);
}
