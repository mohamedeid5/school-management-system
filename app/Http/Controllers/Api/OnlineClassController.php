<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OnlineClassRequest;
use App\Http\Resources\OnlineClassResource;
use App\Models\OnlineClass;
use App\Services\OnlineClassService;
use Illuminate\Support\Facades\Auth;

class OnlineClassController extends BaseApiController
{
    public function __construct(protected OnlineClassService $onlineClassService) {}

    public function index()
    {
        $user = Auth::user();
        $onlineClasses = $this->onlineClassService->getIndexData($user);

        return $this->successResponse(
            OnlineClassResource::collection($onlineClasses['onlineClasses']),
            'Online classes retrieved successfully'
        );
    }

    public function store(OnlineClassRequest $request)
    {
        try {
            $onlineClass = $this->onlineClassService->create($request->validated());

            return $this->createdResponse(
                new OnlineClassResource($onlineClass->load(['subject', 'grade', 'classroom', 'teacher'])),
                'Online class created successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to create online class', 500);
        }
    }

    public function show(OnlineClass $onlineClass)
    {
        $onlineClass->load(['subject', 'grade', 'classroom', 'teacher']);

        return $this->successResponse(
            new OnlineClassResource($onlineClass),
            'Online class retrieved successfully'
        );
    }

    public function update(OnlineClassRequest $request, OnlineClass $onlineClass)
    {
        try {
            $onlineClass = $this->onlineClassService->update($onlineClass, $request->validated());

            return $this->successResponse(
                new OnlineClassResource($onlineClass->fresh(['subject', 'grade', 'classroom', 'teacher'])),
                'Online class updated successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update online class', 500);
        }
    }

    public function destroy(OnlineClass $onlineClass)
    {
        $this->onlineClassService->delete($onlineClass);

        return $this->successResponse(null, 'Online class deleted successfully');
    }
}
