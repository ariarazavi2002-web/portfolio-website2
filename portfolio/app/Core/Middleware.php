<?php

declare(strict_types=1);

namespace App\Core;

interface Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param callable $next
     * @return void
     */
    public function handle(Request $request, callable $next): void;
}
