<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class SectionRepository
{
    public function getIndexData(): array
    {
        $user = Auth::user();

        $grades = Grade::forTeacher($user);

        $classrooms = old('grade_id')
            ? Classroom::where('grade_id', old('grade_id'))->get()
            : [];

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
