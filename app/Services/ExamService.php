<?php

namespace App\Services;

use App\Models\Exam;
use App\Repositories\ExamRepository;

class ExamService
{
    public function __construct(protected ExamRepository $examRepository) {}

    public function getExamIndexData($user): array
    {
        return $this->examRepository->getExamIndexData($user);
    }

    public function createExam(array $data): Exam
    {
        return $this->examRepository->store($data);
    }

    public function updateExam(Exam $exam, array $data): Exam
    {
        return $this->examRepository->update($exam, $data);
    }

    public function deleteExam(Exam $exam): void
    {
        $this->examRepository->delete($exam);
    }
}
