<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use App\Services\ClassroomService;

class ClassroomController extends BaseApiController
{

    public function __construct(protected ClassroomService $classroomService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->classroomService->getIndexData();

        return $this->successResponse(
            ClassroomResource::collection($data['classrooms']),
            'Classrooms retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request)
    {
        $classrooms = $this->classroomService->create($request->validated());

        return $this->createdResponse(
             ClassroomResource::collection(collect($classrooms)),
            'Classroom created successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        $classroom->load('sections')->loadCount('sections');

        return $this->successResponse(
            new ClassroomResource($classroom),
            'Classroom retrieved successfully',
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom = $this->classroomService->update($classroom, $request->validated());

        return $this->successResponse(
            new ClassroomResource($classroom->fresh()),
            'Classroom updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $this->classroomService->delete($classroom);

        return $this->successResponse(
            null,
            'Classroom deleted successfully'
        );
    }
}
