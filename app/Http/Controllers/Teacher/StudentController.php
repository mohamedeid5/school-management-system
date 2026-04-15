<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Student::class);

        $teacher    = Auth::user()->teacher;
        $sectionIds = $teacher ? $teacher->sections()->pluck('sections.id') : collect();

        $students = Student::with(['user', 'grade', 'classroom', 'section'])
            ->whereIn('section_id', $sectionIds)
            ->get();

        return view('teacher.students.index', compact('students'));
    }

    public function show(Student $student)
    {
        Gate::authorize('view', $student);

        $student->load('user', 'grade', 'classroom', 'section');

        return view('teacher.students.show', compact('student'));
    }
}
