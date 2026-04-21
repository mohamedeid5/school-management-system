<?php

namespace App\Services;

use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use App\Exceptions\ClassroomDeletionException;

class ClassroomService
{
    public function __construct(protected ClassroomRepository $classroomRepository) {}

    public function getIndexData(array $filters = []): array
    {
        return $this->classroomRepository->getIndexData($filters);
    }

    public function create(array $listClassrooms): array
    {
        return $this->classroomRepository->create($listClassrooms);
    }

    public function update(Classroom $classroom, array $data): Classroom
    {
        return $this->classroomRepository->update($classroom, $data);
    }

    public function delete(Classroom $classroom): void
    {
        if($classroom->sections()->exists()) {
            throw new ClassroomDeletionException('Cannot delete classroom with associated sections.');
        }

        $this->classroomRepository->delete($classroom);
    }

    public function destroySelected(array $ids): void
    {
        $this->classroomRepository->destroySelected($ids);
    }
}
