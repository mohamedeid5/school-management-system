<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with('grade')->get();
        $grades = Grade::all();
        return view('classrooms.index', compact('classrooms', 'grades'));
    }

    public function store(ClassroomRequest $request): RedirectResponse
    {
        try {

            foreach ($request->list_classrooms as $classroomData) {
                Classroom::create([
                    'name' => [
                        'ar' => $classroomData['name'],
                        'en' => $classroomData['name_en'],
                    ],
                    'grade_id' => $classroomData['grade_id'],
                ]);
            }

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
            Log::error('Classroom creation failed: ' . $e->getMessage());
            toastr()->error(__('main.something_went_wrong'));
            return redirect()->back()->withInput();
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

            return redirect()->back()->withInput();
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

            return redirect()->back()->withInput();
        }
    }
}
