<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionControllerRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with('sections')->get();

        $classrooms = old('grade_id')
            ? $classrooms = Classroom::where('grade_id', old('grade_id'))->get()
            : [];

        return view('sections.index', compact('grades', 'classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionControllerRequest $request)
    {
        try {
            Section::create($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            $this->logError('Section creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionControllerRequest $request, Section $section)
    {
        try {
            $section->update($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            $this->logError('Section update failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        try {
            $section->delete();

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('sections.index');

        } catch (\Exception $e) {
            $this->logError('Section delete failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function getClassrooms($id)
    {
        $classrooms = Classroom::where('grade_id', $id)->pluck('name', 'id');
        return response()->json($classrooms);
    }
}
