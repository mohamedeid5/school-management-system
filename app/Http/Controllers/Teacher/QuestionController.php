<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function __construct(protected QuestionService $questionService) {}

    public function index()
    {
        Gate::authorize('viewAny', Question::class);

        $data = $this->questionService->getQuestionIndexData();

        return view('teacher.questions.index', $data);
    }

    public function create()
    {
        Gate::authorize('create', Question::class);

        $exams = Exam::with(['subject', 'grade', 'classroom'])
            ->where('teacher_id', Auth::user()->teacher->id)
            ->get();

        return view('teacher.questions.create', compact('exams'));
    }

    public function store(QuestionRequest $request)
    {
        Gate::authorize('create', Question::class);

        $this->questionService->createQuestion($request->validated());
        toastr()->success(__('main.created_successfully'));

        return redirect()->route('teacher.questions.index');
    }

    public function edit(Question $question)
    {
        Gate::authorize('update', $question);

        $exams = Exam::with(['subject', 'grade', 'classroom'])
            ->where('teacher_id', Auth::user()->teacher->id)
            ->get();

        return view('teacher.questions.edit', compact('question', 'exams'));
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $this->questionService->updateQuestion($question, $request->validated());
        toastr()->success(__('main.updated_successfully'));

        return redirect()->route('teacher.questions.index');
    }

    public function destroy(Question $question)
    {
        Gate::authorize('delete', $question);

        $this->questionService->deleteQuestion($question);
        toastr()->success(__('main.deleted_successfully'));

        return redirect()->route('teacher.questions.index');
    }
}
