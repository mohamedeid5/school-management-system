<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ParentRequest;
use Illuminate\Http\Request;
use App\Actions\Parents\CreateParentAction;
use App\Actions\Parents\GetParentAction;
use App\Actions\Parents\UpdateParentAction;
use App\Actions\Parents\DeleteParentAction;
use App\Http\Resources\ParentResource;
use App\Models\MyParent;

class ParentController extends BaseApiController
{

    public function __construct(
        protected GetParentAction $getParentAction,
        protected CreateParentAction $createParentAction,
        protected UpdateParentAction $updateParentAction,
        protected DeleteParentAction $deleteParentAction
        ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parents = $this->getParentAction->handle($request->boolean('trashed'));

        return $this->successResponse(
             ParentResource::collection($parents),
            'Parents retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParentRequest $request)
    {
        $parent = $this->createParentAction->handle($request);

        return $this->createdResponse(
            new ParentResource($parent),
            'Parent created successfully.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(MyParent $parent)
    {
        $parent->load('user');

        return $this->successResponse(
            new ParentResource($parent),
            'Parent retrieved successfully.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParentRequest $request, MyParent $parent)
    {
        $parent = $this->updateParentAction->handle($parent, $request);

        return $this->successResponse(
            new ParentResource($parent->fresh('user')),
            'Parent updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyParent $parent)
    {
        $this->deleteParentAction->handle($parent);

        return $this->successResponse(
            null,
            'Parent deleted successfully.'
        );
    }
}
