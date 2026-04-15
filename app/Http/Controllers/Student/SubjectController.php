<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SubjectController extends Controller
{

    public function __construct(protected SubjectService $subjectService) {}

    public function index()
    {
        $user = Auth::user();

        $data = $this->subjectService->getSubjectIndexData($user);

        return view('student.subjects.index', $data);
    }

    public function show(Subject $subject)
    {
        Gate::authorize('view', $subject);

        $student = Auth::user()->student;

        $subject->load('grade', 'classroom', 'teacher.user');

        return view('student.subjects.show', compact('subject'));
    }
}
