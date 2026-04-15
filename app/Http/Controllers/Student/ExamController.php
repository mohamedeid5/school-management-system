<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Services\ExamService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExamController extends Controller
{
    public function __construct(protected ExamService $examService) {}

    public function index()
    {
        $user   = Auth::user();
        $data  = $this->examService->getExamIndexData($user);

        return view('student.exams.index', $data);
    }

   public function show(Exam $exam)
    {

        Gate::authorize('view', $exam);

        $exam->load('questions', 'subject', 'grade', 'classroom', 'teacher');

        return view('student.exams.show', compact('exam'));
    }
}
