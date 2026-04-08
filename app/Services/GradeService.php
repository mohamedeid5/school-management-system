<?php

namespace App\Services;

use App\Models\Grade;
use App\Repositories\GradeRepository;

class GradeService
{
    public function __construct(protected GradeRepository $gradeRepository) {}

    public function getAll()
    {
        return $this->gradeRepository->getAll();
    }

    public function create(array $data): Grade
    {
        return $this->gradeRepository->create($data);
    }

    public function update(Grade $grade, array $data): Grade
    {
        return $this->gradeRepository->update($grade, $data);
    }

    public function delete(Grade $grade): void
    {
        $this->gradeRepository->delete($grade);
    }

    public function hasClassrooms(Grade $grade): bool
    {
        return $this->gradeRepository->hasClassrooms($grade);
    }
}
