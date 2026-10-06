<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    /** @var array<string, array<int, array{pattern: string, regex: string, paramNames: array<string>, handler: mixed, middlewares: array<string>}>> */
    private array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
        'PATCH' => [],
    ];

    /** @var callable|null */
    private $notFoundHandler = null;

    public function get(string $path, callable|array|string $handler, array $middlewares = []): void
    {
        $this->addRoute('GET', $path, $handler, $middlewares);
    }

    public function post(string $path, callable|array|string $handler, array $middlewares = []): void
    {
        $this->addRoute('POST', $path, $handler, $middlewares);
    }

    public function put(string $path, callable|array|string $handler, array $middlewares = []): void
    {
        $this->addRoute('PUT', $path, $handler, $middlewares);
    }

    public function delete(string $path, callable|array|string $handler, array $middlewares = []): void
    {
        $this->addRoute('DELETE', $path, $handler, $middlewares);
    }

    public function setNotFoundHandler(callable $handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addRoute(string $method, string $path, callable|array|string $handler, array $middlewares): void
    {
        $normalizedPath = $this->normalize($path);
        
        // Convert route like /projects/{slug} to regex #^/projects/(?P<slug>[^/]+)$#
        $paramNames = [];
        $regex = preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', function ($matches) use (&$paramNames) {
            $paramNames[] = $matches[1];
            return '(?P<' . $matches[1] . '>[^/]+)';
        }, $normalizedPath);

        $regex = '#^' . $regex . '$#u';

        $this->routes[$method][] = [
            'pattern' => $normalizedPath,
            'regex' => $regex,
            'paramNames' => $paramNames,
            'handler' => $handler,
            'middlewares' => $middlewares,
        ];
    }

    public function dispatch(Request $request): void
    {
        $method = $request->method();
        $path = $this->normalize($request->path());

        $routesForMethod = $this->routes[$method] ?? [];

        foreach ($routesForMethod as $route) {
            if (preg_match($route['regex'], $path, $matches)) {
                $params = [];
                foreach ($route['paramNames'] as $paramName) {
                    if (isset($matches[$paramName])) {
                        $params[$paramName] = $matches[$paramName];
                    }
                }
                $request->setParams($params);

                // Run middlewares pipeline if any
                $this->runPipeline($route['middlewares'], $request, function () use ($route, $request) {
                    $this->invokeHandler($route['handler'], $request);
                });

                return;
            }
        }

        // 404 Not Found
        $this->handleNotFound($request);
    }

    private function runPipeline(array $middlewares, Request $request, callable $destination): void
    {
        $pipeline = array_reduce(
            array_reverse($middlewares),
            function ($next, $middlewareClass) {
                return function (Request $request) use ($middlewareClass, $next) {
                    if (class_exists($middlewareClass)) {
                        $middleware = new $middlewareClass();
                        if (method_exists($middleware, 'handle')) {
                            $middleware->handle($request, $next);
                            return;
                        }
                    }
                    $next($request);
                };
            },
            $destination
        );

        $pipeline($request);
    }

    private function invokeHandler(mixed $handler, Request $request): void
    {
        if (is_callable($handler)) {
            $handler($request);
            return;
        }

        if (is_array($handler) && count($handler) === 2) {
            [$class, $method] = $handler;
            if (is_string($class) && class_exists($class)) {
                $instance = new $class();
                $instance->$method($request);
                return;
            }
        }

        if (is_string($handler) && str_contains($handler, '@')) {
            [$class, $method] = explode('@', $handler, 2);
            if (class_exists($class)) {
                $instance = new $class();
                $instance->$method($request);
                return;
            }
        }

        throw new \RuntimeException('Invalid route handler specified.');
    }

    private function handleNotFound(Request $request): void
    {
        if ($this->notFoundHandler !== null) {
            ($this->notFoundHandler)($request);
            return;
        }

        Response::setStatus(404);
        try {
            View::render('Shared.Views.layouts.404', ['title' => '۴۰۴ - صفحه یافت نشد'], 'Shared.Views.layouts.app');
        } catch (\Throwable) {
            echo '<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><title>صفحه یافت نشد</title></head><body style="background:#070a29;color:#fff;text-align:center;padding:5rem;font-family:sans-serif;"><h1>۴۰۴</h1><p>صفحه مورد نظر یافت نشد.</p><a href="/" style="color:#a855f7;">بازگشت به صفحه اصلی</a></body></html>';
        }
    }

    private function normalize(string $path): string
    {
        $trimmed = '/' . trim($path, '/');
        return $trimmed === '//' ? '/' : $trimmed;
    }
}
