<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Models\Grade;

class SubjectRepository
{
    public function getSubjectIndexData()
    {
        return [
            'grades' => Grade::all(),
            'subjects' => Subject::with(['grade', 'classroom'])->latest()->paginate(20),
        ];
    }

    public function store(array $data): Subject
    {
        return Subject::create($data);
    }

    public function update(Subject $subject, array $data): Subject
    {
        $subject->update($data);

        return $subject;
    }

    public function delete(Subject $subject): void
    {
        $subject->delete();
    }
}

