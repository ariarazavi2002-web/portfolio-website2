<?php

declare(strict_types=1);

namespace App\Features\Home\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Features\Home\Services\HomeService;

final class HomeController
{
    private HomeService $homeService;

    public function __construct(?HomeService $homeService = null)
    {
        $this->homeService = $homeService ?? new HomeService();
    }

    public function index(Request $request): void
    {
        $data = $this->homeService->getHomeData();
        View::render('Features.Home.Views.index', $data, 'Shared.Views.layouts.app');
    }
}
