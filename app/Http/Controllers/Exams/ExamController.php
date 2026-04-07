<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Subject;
use App\Services\ExamService;

class ExamController extends Controller
{
    public function __construct(protected ExamService $examService) {}

    public function index()
    {
        $data = $this->examService->getExamIndexData();

        return view('exams.index', $data);
    }

    public function create()
    {
        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $classrooms = Classroom::where('grade_id', old('grade_id'))->get();

        return view('exams.create', compact('grades', 'subjects', 'classrooms'));
    }

    public function store(ExamRequest $request)
    {
        $this->examService->createExam($request->validated());
        toastr()->success(__('main.created_successfully'));

        return redirect()->route('exams.index');
    }

    public function edit(Exam $exam)
    {
        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $grade_id   = old('grade_id', $exam->grade_id);
        $classrooms = Classroom::where('grade_id', $grade_id)->get();

        return view('exams.edit', compact('exam', 'grades', 'subjects', 'classrooms'));
    }

    public function update(ExamRequest $request, Exam $exam)
    {
        $this->examService->updateExam($exam, $request->validated());
        toastr()->success(__('main.updated_successfully'));

        return redirect()->route('exams.index');
    }

    public function destroy(Exam $exam)
    {
        $this->examService->deleteExam($exam);
        toastr()->success(__('main.deleted_successfully'));

        return redirect()->route('exams.index');
    }
}
