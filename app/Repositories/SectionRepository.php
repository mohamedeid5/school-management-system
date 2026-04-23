<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Support\Facades\Cache;

class SectionRepository
{
    public function getIndexData($user): array
    {
        $gradesCacheKey = 'grades_for_user_' . $user->id;

        $grades = Cache::remember($gradesCacheKey, 3600, function() use ($user) {
            return Grade::authorizedForUser($user)->get();
        });

        $allClassrooms = Cache::rememberForever('all_classrooms', function() {
            return Classroom::latest()->get();
        });


        $oldGradeId = old('grade_id');
        $classrooms = $oldGradeId
            ? $allClassrooms->where('grade_id', $oldGradeId)->values()
            : collect();

        return compact('grades', 'classrooms');
    }

    public function create(array $data): Section
    {
        return Section::create($data);
    }

    public function update(Section $section, array $data): Section
    {
        $section->update($data);

        return $section;
    }

    public function delete(Section $section): void
    {
        $section->delete();
    }
}
