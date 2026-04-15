<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\ExamService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExamController extends Controller
{
    public function __construct(protected ExamService $examService) {}

    public function index()
    {
        $data = $this->examService->getExamIndexData();

        return view('admin.exams.index', $data);
    }

    public function create(): View
    {
        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $classrooms = Classroom::where('grade_id', old('grade_id'))->get();
        $authUser   = Auth::user();
        $teachers   = $authUser->hasRole('admin') ? Teacher::with('user')->get() : collect();

        return view('admin.exams.create', compact('grades', 'subjects', 'classrooms', 'teachers'));
    }

    public function store(ExamRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $teacherId = $user->hasRole('admin')
            ? $request->validated()['teacher_id']
            : $user->teacher->id;

        $data = array_merge($request->validated(), ['teacher_id' => $teacherId]);

        $this->examService->createExam($data);
        toastr()->success(__('main.created_successfully'));

        return redirect()->route('exams.index');
    }

    public function show(Exam $exam): View
    {
        $exam->load('questions', 'subject', 'grade', 'classroom', 'teacher');

        return view('admin.exams.show', compact('exam'));
    }

    public function edit(Exam $exam): View
    {
        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $teachers   = Teacher::all();
        $grade_id   = old('grade_id', $exam->grade_id);
        $classrooms = Classroom::where('grade_id', $grade_id)->get();

        return view('admin.exams.edit', compact('exam', 'grades', 'subjects', 'teachers', 'classrooms'));
    }

    public function update(ExamRequest $request, Exam $exam): RedirectResponse
    {
        $this->examService->updateExam($exam, $request->validated());
        toastr()->success(__('main.updated_successfully'));

        return redirect()->route('exams.index');
    }

    public function destroy(Exam $exam): RedirectResponse
    {
        $this->examService->deleteExam($exam);
        toastr()->success(__('main.deleted_successfully'));

        return redirect()->route('exams.index');
    }
}
