<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Services\QuestionService;

class QuestionController extends BaseApiController
{
    public function __construct(protected QuestionService $questionService) {}

    public function index()
    {
        $data = $this->questionService->getQuestionIndexData();

        return $this->successResponse(
            QuestionResource::collection($data['questions']),
            'Questions retrieved successfully'
        );
    }

    public function store(QuestionRequest $request)
    {
        $question = $this->questionService->createQuestion($request->validated());

        return $this->createdResponse(
            new QuestionResource($question->load('exam')),
            'Question created successfully'
        );
    }

    public function show(Question $question)
    {
        $question->load('exam');

        return $this->successResponse(
            new QuestionResource($question),
            'Question retrieved successfully'
        );
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question = $this->questionService->updateQuestion($question, $request->validated());

        return $this->successResponse(
            new QuestionResource($question->fresh('exam')),
            'Question updated successfully'
        );
    }

    public function destroy(Question $question)
    {
        $this->questionService->deleteQuestion($question);

        return $this->successResponse(null, 'Question deleted successfully');
    }
}
