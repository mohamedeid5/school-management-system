<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\GradeRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $grades = Grade::all();
        return view('grades.index', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request): RedirectResponse
    {
        try {

            $grade = Grade::create($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            Log::error('Grade creation failed for: ' . $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));
            return redirect()->route('grades.index');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, Grade $grade): RedirectResponse
    {
        try {
            $grade->update($request->validated());
            toastr()->success(__('main.updated_successfully'));

            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            Log::error('Grade update failed for ID ' . $grade->id . ': ' . $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->route('grades.index');
        }
    }
    public function destroy(Grade $grade): RedirectResponse
    {
        try {
            if($grade->classrooms()->exists()) {
                toastr()->error('لا يمكن حذف المرحلة الدراسية لأنها تحتوي على صفوف');
                return redirect()->route('grades.index');
            }

            $grade->delete();
            toastr()->success(__('main.deleted_successfully'));

            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            Log::error('Grade deletion failed for ID ' . $grade->id . ': '. $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->route('grades.index');
        }
    }
}
