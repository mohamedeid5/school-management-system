<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Support\Facades\Cache;

class SubjectRepository
{
    public function getSubjectIndexData($user)
    {
        $grades = Cache::rememberForever('all_grades', function() {
            return Grade::all();
        });

        $subjectsCacheKey = 'subjects_for_user_' . $user->id;

        $subjects = Cache::remember($subjectsCacheKey, 3600, function() use ($user) {
            return Subject::authorizedForUser($user)->get();
        });

        return [
            'grades' => $grades,
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

