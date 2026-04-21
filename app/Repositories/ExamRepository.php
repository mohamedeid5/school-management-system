<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class ExamRepository
{
    public function getExamIndexData(): array
    {
        $user = Auth::user();

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
