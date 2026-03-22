<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\DeleteSelectedClassroomsRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;

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

    public function store(ClassroomRequest $request): RedirectResponse
    {
        try {

            DB::transaction(function() use ($request) {
                foreach ($request->list_classrooms as $classroomData) {
                    Classroom::create([
                        'name' => [
                            'ar' => $classroomData['name'],
                            'en' => $classroomData['name_en'],
                        ],
                        'grade_id' => $classroomData['grade_id'],
                    ]);
                }
            });

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
            Log::error('Classroom creation failed: ' . $e->getMessage());
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
            Log::error('Classroom update failed: ' . $e->getMessage());
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
            Log::error('Classroom delete failed: ' . $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function destroySelected(DeleteSelectedClassroomsRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {

            DB::transaction(function() use ($validated) {
                Classroom::whereIn('id', $validated['ids'])->get()->each->delete();
            });

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('classrooms.index');

        } catch (Exception $e) {
             Log::error('Bulk classroom delete failed: ' . $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
