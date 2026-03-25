<?php

namespace App\Http\Controllers\Classrooms;

use App\Actions\Classrooms\CreateClassroomAction;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\DeleteSelectedClassroomsRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(Request $request): View
    {
        $grades = Grade::all();
        $classrooms = Classroom::with('grade')
            ->when($request->grade_id, function($query) use ($request) {
                $query->where('grade_id', $request->grade_id);
            })
            ->latest()
            ->get();

        return view('classrooms.index', compact('classrooms', 'grades'));
    }

    public function store(ClassroomRequest $request, CreateClassroomAction $createClassroomAction): RedirectResponse
    {
        try {
            $createClassroomAction->handle($request);
            toastr()->success(__('main.created_successfully'));

            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            $this->logError('Classroom creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }

    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        try {
            $classroom->update($request->validated());
            toastr()->success(__('main.updated_successfully'));

            return redirect()->route('classrooms.index');
        } catch (Exception $e) {
            $this->logError('Classroom update failed', $e,  ['classroom_id' => $classroom->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
        try {
            $classroom->delete();
            toastr()->success(__('main.deleted_successfully'));

            return redirect()->route('classrooms.index');
        } catch(Exception $e) {
            $this->logError('Classroom delete failed', $e,  ['classroom_id' => $classroom->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function destroySelected(DeleteSelectedClassroomsRequest $request): RedirectResponse
    {
        $request->validated();

        try {
            $classroom = Classroom::destroy($request->ids);

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('classrooms.index');

        } catch (Exception $e) {
            $this->logError('Bulk classroom delete failed', $e,  ['classroom_id' => $request->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
