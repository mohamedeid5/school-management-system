<?php

namespace App\Services;

use App\DTOs\GradeDTO;
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

    public function create(GradeDTO $dto)
    {
        return $this->gradeRepository->create($dto);
    }

    public function update(Grade $grade, GradeDTO $dto): Grade
    {
        return $this->gradeRepository->update($grade, $dto);
    }

    public function delete(Grade $grade)
    {
        if($grade->classrooms()->exists()) {
            throw new GradeDeletionException('Cannot delete grade with associated classrooms');
        }
        $this->gradeRepository->delete($grade);
    }
}
