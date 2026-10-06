<?php

declare(strict_types=1);

namespace App\Core;

final class Request
{
    private array $get;
    private array $post;
    private array $server;
    private array $files;
    private array $cookies;
    private array $params = [];
    private ?array $json = null;

    public function __construct(
        ?array $get = null,
        ?array $post = null,
        ?array $server = null,
        ?array $files = null,
        ?array $cookies = null
    ) {
        $this->get = $get ?? $_GET;
        $this->post = $post ?? $_POST;
        $this->server = $server ?? $_SERVER;
        $this->files = $files ?? $_FILES;
        $this->cookies = $cookies ?? $_COOKIE;
    }

    public function method(): string
    {
        $method = $this->server['REQUEST_METHOD'] ?? 'GET';
        if ($method === 'POST' && isset($this->post['_method'])) {
            return strtoupper((string)$this->post['_method']);
        }
        return strtoupper($method);
    }

    public function path(): string
    {
        $uri = $this->server['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        
        // Remove trailing slash except for root
        if ($path !== '/' && str_ends_with($path, '/')) {
            $path = rtrim($path, '/');
        }

        return $path;
    }

    public function uri(): string
    {
        return $this->server['REQUEST_URI'] ?? '/';
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->get[$key] ?? $default;
    }

    public function post(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $default;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        $all = $this->all();
        return $all[$key] ?? $default;
    }

    public function all(): array
    {
        $json = $this->json();
        if ($json !== null) {
            return array_merge($this->get, $this->post, $json);
        }
        return array_merge($this->get, $this->post);
    }

    public function json(): ?array
    {
        if ($this->json !== null) {
            return $this->json;
        }

        $contentType = $this->header('Content-Type') ?? '';
        if (str_contains($contentType, 'application/json')) {
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);
            if (is_array($data)) {
                $this->json = $data;
                return $this->json;
            }
        }

        return null;
    }

    public function header(string $name, ?string $default = null): ?string
    {
        $key = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($this->server[$key])) {
            return (string)$this->server[$key];
        }

        if (isset($this->server['CONTENT_TYPE']) && strcasecmp($name, 'Content-Type') === 0) {
            return (string)$this->server['CONTENT_TYPE'];
        }

        return $default;
    }

    public function isAjax(): bool
    {
        return strcasecmp($this->header('X-Requested-With') ?? '', 'XMLHttpRequest') === 0;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function param(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }

    public function params(): array
    {
        return $this->params;
    }
}
