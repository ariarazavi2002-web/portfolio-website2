<?php

declare(strict_types=1);

return [
    'name' => 'Daya Creative Studio — Aria Razavi',
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => (bool)(getenv('APP_DEBUG') ?: false),
    'url' => getenv('APP_URL') ?: '',
    'timezone' => 'Asia/Tehran',
];
