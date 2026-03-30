<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherControllerRequest;
use App\Models\Teacher;
use App\Services\TeacherService;

class TeacherController extends Controller
{

    public TeacherService $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = $this->teacherService->getIndexPageData();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->teacherService->getCreatePageData();

        return view('teachers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherControllerRequest $request)
    {
        try {
            $this->teacherService->storeTeacher($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            $this->logError('teacher creation failed', $e);
            toastr()->error(__('main.created_failed'));
            return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $data = $this->teacherService->getEditPageData($teacher);

        return view('teachers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherControllerRequest $request, Teacher $teacher)
    {
        try {
            $this->teacherService->updateTeacher($request->validated(), $teacher);

            toastr()->success(__('main.updated_successfully'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            $this->logError('teacher update failed', $e, ['teacher_id' => $teacher->id]);
            toastr()->error(__('main.updated_failed'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $this->teacherService->deleteTeacher($teacher);

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            $this->logError('teacher deletion failed', $e, ['teacher_id' => $teacher->id]);
            toastr()->error(__('main.deleted_failed'));
            return redirect()->back();
        }
    }
}
