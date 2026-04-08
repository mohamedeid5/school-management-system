<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\Grade;

class ExamRepository
{
    public function getExamIndexData(): array
    {
        return [
            'grades' => Grade::all(),
            'exams'  => Exam::with(['subject', 'grade', 'classroom'])->latest()->get(),
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
