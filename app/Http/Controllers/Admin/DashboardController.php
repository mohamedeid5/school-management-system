<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;

class DashboardController extends Controller
{
    public function __construct(protected AdminDashboardService $dashboardService) {}

    public function index()
    {
        $data = $this->dashboardService->getDashboardStats();

        return view('admin.dashboard', $data);
    }
}
