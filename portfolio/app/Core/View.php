<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    /**
     * Render a view template, optionally wrapped in a layout.
     *
     * @param string $view Dot notation view path (e.g. 'Features.Home.Views.index')
     * @param array<string, mixed> $data Variables passed to the view and layout
     * @param string|null $layout Dot notation layout path or null for standalone
     */
    public static function render(string $view, array $data = [], ?string $layout = 'Shared.Views.layouts.app'): void
    {
        $viewFile = self::resolvePath($view);
        if (!is_file($viewFile)) {
            throw new \RuntimeException("View file not found: [{$viewFile}]");
        }

        // Render view content into buffer
        $content = self::renderFile($viewFile, $data);

        // If no layout is requested, output content directly
        if ($layout === null) {
            echo $content;
            return;
        }

        // Render layout wrapping the content
        $layoutFile = self::resolvePath($layout);
        if (!is_file($layoutFile)) {
            throw new \RuntimeException("Layout file not found: [{$layoutFile}]");
        }

        $layoutData = array_merge($data, ['content' => $content]);
        echo self::renderFile($layoutFile, $layoutData);
    }

    /**
     * Render a reusable component from app/Shared/Views/components/
     *
     * @param string $component Component name (e.g. 'header', 'footer', 'card')
     * @param array<string, mixed> $data Variables passed to component
     */
    public static function component(string $component, array $data = []): void
    {
        $componentFile = BASE_PATH . '/app/Shared/Views/components/' . str_replace('.', '/', $component) . '.php';
        if (!is_file($componentFile)) {
            throw new \RuntimeException("Component not found: [{$componentFile}]");
        }

        echo self::renderFile($componentFile, $data);
    }

    private static function resolvePath(string $path): string
    {
        return BASE_PATH . '/app/' . str_replace('.', '/', $path) . '.php';
    }

    private static function renderFile(string $file, array $data): string
    {
        extract($data, EXTR_SKIP);
        ob_start();
        require $file;
        return (string)ob_get_clean();
    }
}
