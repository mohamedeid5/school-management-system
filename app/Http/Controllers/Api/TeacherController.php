<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TeacherRequest;
use App\Services\TeacherService;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;

class TeacherController extends BaseApiController
{

    public function __construct(protected TeacherService $teacherService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = $this->teacherService->getIndexPageData();
        return $this->successResponse(
            data: TeacherResource::collection($teachers),
            message: 'Teachers retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        $teacher = $this->teacherService->storeTeacher($request->validated());
        return $this->createdResponse(
            new TeacherResource($teacher),
            'Teacher created successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $teacher = $this->teacherService->getTeacherById($teacher->id);

        return $this->successResponse(
            new TeacherResource($teacher),
            'Teacher retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $this->teacherService->updateTeacher($request->validated(), $teacher);

        return $this->successResponse(
            new TeacherResource($teacher->fresh('user', 'specialization', 'sections.classroom')),
            'Teacher updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $this->teacherService->deleteTeacher($teacher);

        return $this->successResponse(
            null,
            'Teacher deleted successfully'
        );
    }
}
