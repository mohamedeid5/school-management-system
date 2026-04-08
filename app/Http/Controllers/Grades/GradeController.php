<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\GradeRequest;
use App\Services\GradeService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GradeController extends Controller
{
    public function __construct(protected GradeService $gradeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $grades = $this->gradeService->getAll();
        return view('grades.index', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request): RedirectResponse
    {
        try {
            $this->gradeService->create($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            $this->logError('Grade creation failed', $e);
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
            $this->gradeService->update($grade, $request->validated());
            toastr()->success(__('main.updated_successfully'));

            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            $this->logError('Grade update failed', $e, ['grade_id' => $grade->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->route('grades.index');
        }
    }

    public function destroy(Grade $grade): RedirectResponse
    {
        try {
            if($this->gradeService->hasClassrooms($grade)) {
                toastr()->error('لا يمكن حذف المرحلة الدراسية لأنها تحتوي على صفوف');
                return redirect()->route('grades.index');
            }

            $this->gradeService->delete($grade);
            toastr()->success(__('main.deleted_successfully'));

            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            $this->logError('Grade deletion failed', $e, ['grade_id' => $grade->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->route('grades.index');
        }
    }

}
