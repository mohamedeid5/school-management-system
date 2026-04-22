<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StudentRequest;
use App\Services\StudentService;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends BaseApiController
{

    public function __construct(protected StudentService $studentService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $students = $this->studentService->getAllStudents($user);
        return $this->successResponse(
            StudentResource::collection($students),
            'Students retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $student = $this->studentService->storeStudent($request->validated());
        return $this->createdResponse(
            new StudentResource($student),
            'Student created successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['user', 'grade', 'classroom', 'section', 'parent', 'nationality', 'bloodType']);

         return $this->successResponse(
            new StudentResource($student),
            'Student retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student = $this->studentService->updateStudent($request->validated(), $student);

        return $this->successResponse(
            new StudentResource($student->fresh('user', 'grade', 'classroom', 'section', 'parent', 'nationality', 'bloodType')),
            'Student updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $this->studentService->deleteStudent($student);

        return $this->successResponse(
            null,
            'Student deleted successfully'
        );
    }
}
