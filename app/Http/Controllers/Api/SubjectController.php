<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SectionResource;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use App\Models\User;
use App\Services\SubjectService;

class SubjectController extends BaseApiController
{

    public function __construct(protected SubjectService $subjectService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(2);
        $data = $this->subjectService->getSubjectIndexData($user);

        return $this->successResponse(
            SectionResource::collection($data['subjects'])
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $subject = $this->subjectService->createSubject($request->validated());

        return $this->createdResponse(
            new SectionResource($subject),
            'Subject created successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return $this->successResponse(
            new SubjectResource($subject->load(['grade', 'classroom'])),
            'Subject retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject = $this->subjectService->updateSubject($subject, $request->validated());

        return $this->successResponse(
            new SubjectResource($subject->fresh()),
            'Subject updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $this->subjectService->deleteSubject($subject);

        return $this->successResponse(
            null,
            'Subject deleted successfully'
        );
    }
}
