<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\DashboardResource;
use App\Services\AdminDashboardService;

class DashboardController extends BaseApiController
{
    public function __construct(protected AdminDashboardService $dashboardService) {}

    public function index()
    {
        $data = $this->dashboardService->getDashboardStats();

        return $this->successResponse(
            new DashboardResource($data),
            'Dashboard data retrieved successfully'
        );
    }

}
