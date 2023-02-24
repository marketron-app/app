<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Statistics\StatisticService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(private StatisticService $statisticService){

    }
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            "totalUsers" => $this->statisticService->getNumberOfTotalUsers(),
            "newUsers" => $this->statisticService->getNumberOfTotalUsers(now()->subDay(), now()),
            "totalImages" => $this->statisticService->getNumberOfTotalImages(),
            "newImages" => $this->statisticService->getNumberOfTotalImages(now()->subDay(), now()),
        ]);
    }
}
