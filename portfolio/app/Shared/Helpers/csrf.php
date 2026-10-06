<?php

declare(strict_types=1);

if (!function_exists('csrf_token')) {
    /**
     * Get or generate the current session CSRF token.
     */
    function csrf_token(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    /**
     * Generate an HTML hidden input containing the CSRF token.
     */
    function csrf_field(): string
    {
        $token = csrf_token();
        return '<input type="hidden" name="_csrf" value="' . e($token) . '">';
    }
}

if (!function_exists('csrf_verify')) {
    /**
     * Verify the supplied CSRF token against the session token.
     */
    function csrf_verify(?string $token): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $sessionToken = $_SESSION['_csrf_token'] ?? '';
        if (empty($sessionToken) || empty($token)) {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }
}
