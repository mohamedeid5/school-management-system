<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public StudentService $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $students = $this->studentService->getAllStudents($user);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->studentService->getCreatePageData();

        return view('admin.students.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        try {
            $this->studentService->storeStudent($request->validated());
            toastr()->success(__('main.created_successfully'));

            return redirect()->route('students.index');
        } catch (\Exception $e) {
            $this->logError('Student creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $data = $this->studentService->getEditPageData($student);

        return view('admin.students.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        try {
            $this->studentService->updateStudent($request->validated(), $student);
            toastr()->success(__('main.updated_successfully'));

            return redirect()->route('students.index');
        } catch (\Exception $e) {
            $this->logError('Student update failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $this->studentService->deleteStudent($student);
            toastr()->success(__('main.deleted_successfully'));

            return redirect()->route('students.index');
        } catch (\Exception $e) {
            $this->logError('Student deletion failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
