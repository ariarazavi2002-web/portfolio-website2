<?php

declare(strict_types=1);

if (!function_exists('asset')) {
    /**
     * Generate a clean path for static assets, preventing double-prefixing.
     */
    function asset(string $path): string
    {
        $clean = ltrim($path, '/');
        if (str_starts_with($clean, 'assets/')) {
            return $clean;
        }
        return 'assets/' . $clean;
    }
}

if (!function_exists('url')) {
    /**
     * Generate an application URL.
     */
    function url(string $path = ''): string
    {
        return '/' . ltrim($path, '/');
    }
}
