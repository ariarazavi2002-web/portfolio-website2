<?php

declare(strict_types=1);

// Locate bootstrap file supporting both local development and shared hosting deployment
$bootstrapCandidatePaths = [
    __DIR__ . '/../bootstrap.php',
    __DIR__ . '/../portfolio/bootstrap.php',
    dirname(__DIR__, 2) . '/portfolio/bootstrap.php',
];

$bootstrapLoaded = false;
foreach ($bootstrapCandidatePaths as $candidate) {
    if (is_file($candidate)) {
        require_once $candidate;
        $bootstrapLoaded = true;
        break;
    }
}

if (!$bootstrapLoaded) {
    http_response_code(500);
    echo 'Application bootstrap file not found. Check deployment path.';
    exit(1);
}

use App\Core\Request;
use App\Core\Router;

$router = new Router();

// Automatically register routes from all independent features
$featureRoutes = glob(BASE_PATH . '/app/Features/*/routes.php') ?: [];
foreach ($featureRoutes as $routeFile) {
    $registerRoutes = require $routeFile;
    if (is_callable($registerRoutes)) {
        $registerRoutes($router);
    }
}

// Dispatch the incoming HTTP request
$router->dispatch(new Request());
