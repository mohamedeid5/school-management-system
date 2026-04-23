<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\DeleteSelectedClassroomsRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Services\ClassroomService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Exceptions\ClassroomDeletionException;

class ClassroomController extends Controller
{
    public function __construct(protected ClassroomService $classroomService) {}

    public function index(Request $request): View
    {
        $data = $this->classroomService->getIndexData($request->only('grade_id'));

        return view('admin.classrooms.index', $data);
    }

    public function store(ClassroomRequest $request): RedirectResponse
    {
        try {
            $this->classroomService->create($request->validated());
            toastr()->success(__('main.created_successfully'));

            return redirect()->route('admin.classrooms.index');
        } catch (\Exception $e) {
            $this->logError('Classroom creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        try {
            $this->classroomService->update($classroom, $request->validated());
            toastr()->success(__('main.updated_successfully'));

            return redirect()->route('admin.classrooms.index');
        } catch (Exception $e) {
            $this->logError('Classroom update failed', $e,  ['classroom_id' => $classroom->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
        try {
            $this->classroomService->delete($classroom);
            toastr()->success(__('main.deleted_successfully'));

            return redirect()->route('admin.classrooms.index');
        } catch (ClassroomDeletionException $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        } catch (Exception $e) {
            $this->logError('Classroom delete failed', $e,  ['classroom_id' => $classroom->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function destroySelected(DeleteSelectedClassroomsRequest $request): RedirectResponse
    {
        $request->validated();

        try {
            $this->classroomService->destroySelected($request->ids);

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('admin.classrooms.index');

        } catch (Exception $e) {
            $this->logError('Bulk classroom delete failed', $e,  ['classroom_id' => $request->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
