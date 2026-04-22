<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ExamRequest;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use App\Services\ExamService;
use Illuminate\Support\Facades\Auth;

class ExamController extends BaseApiController
{
    public function __construct(protected ExamService $examService) {}

    public function index()
    {
        $user = Auth::user();

        $data = $this->examService->getExamIndexData($user);

        return $this->successResponse(
            ExamResource::collection($data['exams']),
            'Exams retrieved successfully'
        );
    }

    public function store(ExamRequest $request)
    {
        $data = $request->validated();
        $exam = $this->examService->createExam($data);

        return $this->createdResponse(
            new ExamResource($exam->load(['subject', 'grade', 'classroom', 'teacher.user'])),
            'Exam created successfully'
        );
    }

    public function show(Exam $exam)
    {
        $exam->load(['subject', 'grade', 'classroom', 'teacher.user', 'questions']);

        return $this->successResponse(
            new ExamResource($exam),
            'Exam retrieved successfully'
        );
    }

    public function update(ExamRequest $request, Exam $exam)
    {
        $exam = $this->examService->updateExam($exam, $request->validated());

        return $this->successResponse(
            new ExamResource($exam->fresh(['subject', 'grade', 'classroom', 'teacher.user'])),
            'Exam updated successfully'
        );
    }

    public function destroy(Exam $exam)
    {
        $this->examService->deleteExam($exam);

        return $this->successResponse(null, 'Exam deleted successfully');
    }
}
