<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Services\QuestionService;

class QuestionController extends Controller
{
    public function __construct(protected QuestionService $questionService) {}

    public function index()
    {
        $data = $this->questionService->getQuestionIndexData();

        return view('admin.questions.index', $data);
    }

    public function create()
    {
        $exams = Exam::with(['subject', 'grade', 'classroom'])->get();

        return view('admin.questions.create', compact('exams'));
    }

    public function store(QuestionRequest $request)
    {
        $this->questionService->createQuestion($request->validated());
        toastr()->success(__('main.created_successfully'));

        return redirect()->route('questions.index');
    }

    public function edit(Question $question)
    {
        $exams = Exam::with(['subject', 'grade', 'classroom'])->get();

        return view('admin.questions.edit', compact('question', 'exams'));
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $this->questionService->updateQuestion($question, $request->validated());
        toastr()->success(__('main.updated_successfully'));

        return redirect()->route('questions.index');
    }

    public function destroy(Question $question)
    {
        $this->questionService->deleteQuestion($question);
        toastr()->success(__('main.deleted_successfully'));

        return redirect()->route('questions.index');
    }
}
