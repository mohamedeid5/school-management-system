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

    public function storeAttendance(array $data): bool
    {
        return $this->attendanceRepository->createFromApi($data);
    }

    public function getBySection(int $sectionId, string $date)
    {
        return $this->attendanceRepository->getBySection($sectionId, $date);
    }
}
