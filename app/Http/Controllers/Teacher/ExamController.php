<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Subject;
use App\Services\ExamService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExamController extends Controller
{
    public function __construct(protected ExamService $examService) {}

    public function index()
    {
        Gate::authorize('viewAny', Exam::class);

        $data = $this->examService->getExamIndexData();

        return view('teacher.exams.index', $data);
    }

    public function create()
    {
        Gate::authorize('create', Exam::class);

        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $classrooms = Classroom::where('grade_id', old('grade_id'))->get();

        return view('teacher.exams.create', compact('grades', 'subjects', 'classrooms'));
    }

    public function store(ExamRequest $request)
    {
        Gate::authorize('create', Exam::class);

        $teacher_id = Auth::user()->teacher->id;

        $data = array_merge($request->validated(), ['teacher_id' => $teacher_id]);

        $this->examService->createExam($data);
        toastr()->success(__('main.created_successfully'));

        return redirect()->route('teacher.exams.index');
    }

    public function show(Exam $exam)
    {

        Gate::authorize('view', $exam);

        $exam->load('questions', 'subject', 'grade', 'classroom', 'teacher');

        return view('teacher.exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        Gate::authorize('update', $exam);

        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $grade_id   = old('grade_id', $exam->grade_id);
        $classrooms = Classroom::where('grade_id', $grade_id)->get();

        return view('teacher.exams.edit', compact('exam', 'grades', 'subjects', 'classrooms'));
    }

    public function update(ExamRequest $request, Exam $exam)
    {
        Gate::authorize('update', $exam);

        $this->examService->updateExam($exam, $request->validated());
        toastr()->success(__('main.updated_successfully'));

        return redirect()->route('teacher.exams.index');
    }

    public function destroy(Exam $exam)
    {
        Gate::authorize('delete', $exam);

        $this->examService->deleteExam($exam);
        toastr()->success(__('main.deleted_successfully'));

        return redirect()->route('teacher.exams.index');
    }
}
