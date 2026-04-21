<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SectionRequest;
use App\Http\Resources\GradeResource;
use App\Services\SectionService;
use App\Http\Resources\SectionResource;
use App\Models\User;
use App\Models\Section;

class SectionController extends BaseApiController
{

    public function __construct(protected SectionService $sectionService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(2);

        $data = $this->sectionService->getIndexData($user);

        return $this->successResponse(
            GradeResource::collection($data['grades']),
            'Sections retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        $section = $this->sectionService->create($request->validated());

        return $this->createdResponse(
            new SectionResource($section),
            'Section created successfully',
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        $section->load(['grade', 'classroom']);

        return $this->successResponse(
            new SectionResource($section),
            'Section retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request,  Section $section)
    {
        $section = $this->sectionService->update($section, $request->validated());

        return $this->successResponse(
            new SectionResource($section->fresh()),
            'Section updated successfully',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $this->sectionService->delete($section);

        return $this->successResponse(
            null,
            'Section deleted successfully',
        );
    }
}
