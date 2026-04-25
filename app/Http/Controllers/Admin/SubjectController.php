<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Grade;
use App\Models\Subject;
use App\Services\SubjectService;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function __construct(protected SubjectService $subjectService) {}

    public function index()
    {
        $user = Auth::user();

        $data = $this->subjectService->getSubjectIndexData($user);

        return view('admin.subjects.index', $data);
    }

    public function create()
    {
        $grades = Grade::with('classrooms')->get();
        $teachers = Teacher::all();
        $classrooms = Classroom::where('grade_id', old('grade_id'))->get();
        return view('admin.subjects.create', compact('grades', 'teachers', 'classrooms'));
    }

    public function store(SubjectRequest $request)
    {
        $this->subjectService->createSubject($request->validated());
        toastr()->success(__('main.created_successfully'));

        return redirect()->route('admin.subjects.index');
    }

    public function edit(Subject $subject)
    {
        $grades = Grade::with('classrooms')->get();
        $teachers = Teacher::all();
        $grade_id = old('grade_id', $subject->grade_id);
        $classrooms = Classroom::where('grade_id', $grade_id)->get();
        return view('admin.subjects.edit', compact('subject', 'grades', 'teachers', 'classrooms'));
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $this->subjectService->updateSubject($subject, $request->validated());
        toastr()->success(__('main.updated_successfully'));

        return redirect()->route('admin.subjects.index');
    }

    public function destroy(Subject $subject)
    {
        $this->subjectService->deleteSubject($subject);
        toastr()->success(__('main.deleted_successfully'));

        return redirect()->route('admin.subjects.index');
    }
}

