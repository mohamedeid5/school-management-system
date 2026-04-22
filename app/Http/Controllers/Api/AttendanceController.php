<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AttendanceApiRequest;
use App\Services\AttendanceService;
use App\Http\Resources\AttendanceResource;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends BaseApiController
{
    public function __construct(protected AttendanceService $attendanceService) {}

    public function index()
    {
        $user = Auth::user();

        $data = $this->attendanceService->getAttendanceIndexData($user);

        return $this->successResponse(
            AttendanceResource::collection($data['grades']),
            'Attendance retrieved successfully'
        );
    }

    public function store(AttendanceApiRequest $request)
    {
        $this->attendanceService->storeAttendance($request->validated());

        return $this->createdResponse(null, 'Attendance recorded successfully');
    }
}
