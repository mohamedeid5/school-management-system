<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use App\Models\User;
use App\Services\GradeService;

class GradeController extends BaseApiController
{

    public function __construct(protected GradeService $gradeService) {}

    public function index()
    {
        $user = User::find(2);

        $grades = $this->gradeService->getAll($user);

        return $this->successResponse(
            GradeResource::collection($grades),
            'Grades retrieved successfully'
        );
    }

    public function store(GradeRequest $request)
    {
        $grade = $this->gradeService->create($request->validated());

        return $this->createdResponse(
            new GradeResource($grade),
            'Grade created successfully'
        );
    }

    public function show(Grade $grade)
    {
        $grade->load('classrooms')->loadCount('classrooms');

        return $this->successResponse(
            new GradeResource($grade),
            'Grade retrieved successfully'
        );
    }

    public function update(GradeRequest $request, Grade $grade)
    {
        $grade = $this->gradeService->update($grade, $request->validated());

        return $this->successResponse(
            new GradeResource($grade->fresh()),
            'Grade updated Successfully'
        );
    }

    public function destroy(Grade $grade)
    {
        $this->gradeService->delete($grade);

        return $this->successResponse(
            null,
            'Grade deleted successfully'
        );
    }
}
