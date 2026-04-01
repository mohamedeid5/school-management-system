<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Promotion;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;

class PromotionRepository
{
    public function getGrades()
    {
        return Grade::all();
    }

    public function getClassrooms($gradeId)
    {
        return Classroom::where('grade_id', $gradeId)->get();
    }

    public function getSections($classroomId)
    {
        return Section::where('classroom_id', $classroomId)->get();
    }

    public function getAllPromotions()
    {
        return Promotion::with(['student', 'fromGrade', 'fromClassroom', 'fromSection', 'toGrade', 'toClassroom', 'toSection'])->get();
    }

    public function promote($request)
    {
        $studentIds = Student::where('grade_id', $request->from_grade_id)
                    ->where('classroom_id', $request->from_classroom_id)
                    ->where('section_id', $request->from_section_id)
                    ->where('academic_year', $request->academic_year)
                    ->pluck('id');

        if ($studentIds->isEmpty()) {
            throw new \Exception('No students found for the specified criteria.');
        }

        Student::whereIn('id', $studentIds)->update([
            'grade_id' => $request->to_grade_id,
            'classroom_id' => $request->to_classroom_id,
            'section_id' => $request->to_section_id,
            'academic_year' => $request->academic_year_new,
        ]);

        $promotionsData = [];

        foreach ($studentIds as $student) {

            $promotionsData[] = [
                'student_id' => $student,
                'from_grade_id' => $request->from_grade_id,
                'from_classroom_id' => $request->from_classroom_id,
                'from_section_id' => $request->from_section_id,
                'to_grade_id' => $request->to_grade_id,
                'to_classroom_id' => $request->to_classroom_id,
                'to_section_id' => $request->to_section_id,
                'academic_year' => $request->academic_year,
                'academic_year_new' => $request->academic_year_new,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Promotion::insert($promotionsData);

    }

    public function restore($request)
    {
        $promotions = $request->page_id == 'all'
                ? Promotion::query()->get()
                : Promotion::where('id', $request->id)->get();

        if ($promotions->isEmpty()) {
            return false;
        }

        $groupped = $promotions->groupBy(function($item) {
            return $item->from_grade_id . '-' .
                   $item->from_classroom_id . '-' .
                   $item->from_section_id . '-' .
                   $item->academic_year;
        });

        foreach($groupped as $group)
        {
            $studentIds = $group->pluck('student_id');
            $destination = $group->first();

             Student::whereIn('id', $studentIds)->update([
                'grade_id' => $destination->from_grade_id,
                'classroom_id' => $destination->from_classroom_id,
                'section_id' => $destination->from_section_id,
                'academic_year' => $destination->academic_year,
            ]);
        }

        if ($request->page_id == 'all') {
            Promotion::query()->delete();
        } else {
            Promotion::destroy($request->id);
        }
    }
}
