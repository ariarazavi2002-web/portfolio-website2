<?php

declare(strict_types=1);

if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__);
}

// Load application configuration
$config = require BASE_PATH . '/config/app.php';

// Configure error reporting based on environment
if (!empty($config['debug'])) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('log_errors', '1');
    
    $logDir = BASE_PATH . '/storage/logs';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    ini_set('error_log', $logDir . '/error.log');
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
}

// Timezone
if (!empty($config['timezone'])) {
    date_default_timezone_set($config['timezone']);
}

// Secure session configuration
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.use_strict_mode', '1');
    
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        ini_set('session.cookie_secure', '1');
    }

    session_start();
}

// Register PSR-4 Autoloader (maps App\ to app/)
spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = BASE_PATH . '/app/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

// Load core procedural helpers
require_once BASE_PATH . '/app/Shared/Helpers/escape.php';
require_once BASE_PATH . '/app/Shared/Helpers/csrf.php';
require_once BASE_PATH . '/app/Shared/Helpers/url.php';

return $config;
