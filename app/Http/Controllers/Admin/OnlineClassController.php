<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnlineClassRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\OnlineClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\OnlineClassService;
use Illuminate\Support\Facades\Gate;

class OnlineClassController extends Controller
{
    public function __construct(protected OnlineClassService $onlineClassService) {}

    public function index()
    {

        Gate::authorize('viewAny', OnlineClass::class);

        $data = $this->onlineClassService->getIndexData();

        return view('admin.online_classes.index', $data);
    }

    public function create()
    {
        Gate::authorize('create', OnlineClass::class);

        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $teachers   = Teacher::all();
        $classrooms = Classroom::where('grade_id', old('grade_id'))->get();

        return view('admin.online_classes.create', compact('grades', 'subjects', 'teachers', 'classrooms'));
    }

    public function store(OnlineClassRequest $request)
    {
        Gate::authorize('create', OnlineClass::class);

        try {
            $this->onlineClassService->create($request->validated());
            toastr()->success(__('main.created_successfully'));

            return redirect()->route('online-classes.index');
        } catch (\Exception $e) {
            toastr()->error(__('main.something_went_wrong'));
            $this->logError('Online class creation failed', $e);
            return redirect()->back()->withInput();
        }
    }

    public function show(OnlineClass $onlineClass)
    {

        Gate::authorize('view', $onlineClass);

        $onlineClass->load('subject', 'grade', 'classroom', 'teacher');

        return view('admin.online_classes.show', compact('onlineClass'));
    }

    public function edit(OnlineClass $onlineClass)
    {
        Gate::authorize('update', $onlineClass);

        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $teachers   = Teacher::all();
        $grade_id   = old('grade_id', $onlineClass->grade_id);
        $classrooms = Classroom::where('grade_id', $grade_id)->get();

        return view('admin.online_classes.edit', compact('onlineClass', 'grades', 'subjects', 'teachers', 'classrooms'));
    }

    public function update(OnlineClassRequest $request, OnlineClass $onlineClass)
    {
        Gate::authorize('update', $onlineClass);

        try {
            $this->onlineClassService->update($onlineClass, $request->validated());
            toastr()->success(__('main.updated_successfully'));

            return redirect()->route('online-classes.index');
        } catch (\Exception $e) {
            toastr()->error(__('main.something_went_wrong'));
           $this->logError('Online class update failed', $e, ['online_class_id' => $onlineClass->id]);
            return redirect()->back()->withInput();
        }

    }

    public function destroy(OnlineClass $onlineClass)
    {
        Gate::authorize('delete', $onlineClass);

        try {
            $this->onlineClassService->delete($onlineClass);
            toastr()->success(__('main.deleted_successfully'));

            return redirect()->route('online-classes.index');
        } catch (\Exception $e) {
            toastr()->error(__('main.something_went_wrong'));
           $this->logError('Online class deletion failed', $e, ['online_class_id' => $onlineClass->id]);
            return redirect()->back();
        }
    }
}
