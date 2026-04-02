<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;

class GraduationRepository
{
    public function getAllGraduatedStudents()
    {
        return Student::onlyTrashed()->get();
    }

    public function getAllGrades()
    {
        return Grade::all();
    }

    public function getAllClassrooms($gradeId)
    {
        return Classroom::where('grade_id', $gradeId)->get();
    }

    public function getAllSections($classroomId)
    {
        return Section::where('classroom_id', $classroomId)->get();
    }

    public function softDeleteStudents($request)
    {
        return Student::where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)
            ->chunkById(100, function($students) {
                $students->each->delete();
            });
    }

    public function restore($id)
    {
        return Student::onlyTrashed()->findOrFail($id)->restore();
    }

    public function forceDelete($id)
    {
        return Student::onlyTrashed()->findOrFail($id)->forceDelete();
    }
}
