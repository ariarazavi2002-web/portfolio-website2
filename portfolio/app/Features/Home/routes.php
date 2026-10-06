<?php

declare(strict_types=1);

use App\Core\Router;
use App\Features\Home\Controllers\HomeController;

return static function (Router $router): void {
    $router->get('/', [HomeController::class, 'index']);
    $router->get('/home', [HomeController::class, 'index']);
};
