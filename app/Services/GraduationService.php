<?php

namespace App\Services;

use App\Repositories\GraduationRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class GraduationService
{
    protected GraduationRepository $graduationRepository;

    public function __construct(GraduationRepository $graduationRepository)
    {
        $this->graduationRepository = $graduationRepository;
    }

    public function getGraduationPageData()
    {
        $graduatedStudents = $this->graduationRepository->getAllGraduatedStudents();

        return [
            'students' => $graduatedStudents,
        ];
    }

    public function getCreatePageData()
    {
        $classrooms = old('grade_id')
                ? $this->graduationRepository->getAllClassrooms(old('grade_id'))
                : collect();

        $sections = old('classroom_id')
                ? $this->graduationRepository->getAllSections(old('classroom_id'))
                : collect();

        return [
            'grades' => $this->graduationRepository->getAllGrades(),
            'classrooms' => $classrooms,
            'sections' => $sections
        ];
    }

    public function graduate($request)
    {
        DB::transaction(function () use ($request) {

            $count = Student::where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)
            ->count();

             if ($count < 1) {
                throw new \Exception('No students found for the specified criteria.');
             }

            $this->graduationRepository->softDeleteStudents($request);
        });

        return true;
    }


}
