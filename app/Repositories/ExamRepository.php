<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\Grade;

class ExamRepository
{
    public function getExamIndexData($user): array
    {
        $exams = Exam::authorizedForUser($user)
                ->with(['subject', 'grade', 'classroom', 'teacher.user'])
                ->latest()
                ->get();

        return [
            'grades' => Grade::all(),
            'exams'  => $exams,
        ];
    }

    public function store(array $data): Exam
    {
        return Exam::create($data);
    }

    public function update(Exam $exam, array $data): Exam
    {
        $exam->update($data);

        return $exam;
    }

    public function delete(Exam $exam): void
    {
        $exam->delete();
    }
}
