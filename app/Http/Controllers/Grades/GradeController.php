<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\GradeRequest;
use Illuminate\Support\Facades\Log;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('grades.index', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request)
    {
        try {

            $grade = Grade::create($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            Log::error('Grade creation failed: ' . $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));
            return redirect()->back()->withInput();
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, Grade $grade)
    {
        try {
            $grade->update($request->validated());

            toastr()->success(__('main.updated_successfully'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            Log::error('Grade update failed: ' . $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back()->withInput();
        }
    }
    public function destroy(Grade $grade)
    {
        try {

            $grade->delete();

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            Log::error('Grade deletion failed: ' . $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
