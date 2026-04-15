<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;

class AttendanceService
{
    public function __construct(protected AttendanceRepository $attendanceRepository) {}

    public function getAttendanceIndexData($user)
    {
        return $this->attendanceRepository->getAttendanceIndexData($user);
    }

    public function show($id)
    {
        return $this->attendanceRepository->show($id);
    }

    public function createAttendance($data)
    {
        return $this->attendanceRepository->create($data);
    }
}
