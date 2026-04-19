<?php

namespace App\Services;

use App\Exceptions\GradeDeletionException;
use App\Models\Grade;
use App\Repositories\GradeRepository;

class GradeService
{
    public function __construct(protected GradeRepository $gradeRepository) {}

    public function getAll($user)
    {
        return $this->gradeRepository->getAll($user);
    }

    public function create(array $data): Grade
    {
        return $this->gradeRepository->create($data);
    }

    public function update(Grade $grade, array $data): Grade
    {
        return $this->gradeRepository->update($grade, $data);
    }

    public function delete(Grade $grade)
    {
        if($grade->classrooms()->exists()) {
            throw new GradeDeletionException('Cannot delete grade with associated classrooms');
        }
        $this->gradeRepository->delete($grade);
    }
}
