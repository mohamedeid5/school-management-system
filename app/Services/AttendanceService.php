<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;

class AttendanceService
{
    public function __construct(protected AttendanceRepository $attendanceRepository) {}

    public function getAttendanceIndexData()
    {
        return $this->attendanceRepository->getAttendanceIndexData();
    }

    public function createAttendance($data)
    {
        return $this->attendanceRepository->create($data);
    }
}
