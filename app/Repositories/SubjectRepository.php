<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Models\Grade;

class SubjectRepository
{
    public function getSubjectIndexData($user)
    {
       $subjects = Subject::authorizedForUser($user)->get();

        return [
            'grades' => Grade::all(),
            'subjects' => $subjects,
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

