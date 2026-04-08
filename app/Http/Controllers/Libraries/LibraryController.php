<?php

namespace App\Http\Controllers\Libraries;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Section;
use App\Models\Subject;
use App\Services\LibraryService;

class LibraryController extends Controller
{
    public function __construct(protected LibraryService $libraryService) {}

    public function index()
    {
        $data = $this->libraryService->getIndexData();

        return view('libraries.index', $data);
    }

    public function create()
    {
        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $classrooms = Classroom::where('grade_id', old('grade_id'))->get();
        $sections   = Section::where('classroom_id', old('classroom_id'))->get();

        return view('libraries.create', compact('grades', 'subjects', 'classrooms', 'sections'));
    }

    public function store(LibraryRequest $request)
    {
        try {
            $this->libraryService->create($request->validated());
            toastr()->success(__('main.created_successfully'));

            return redirect()->route('libraries.index');
        } catch (\Exception $e) {
            toastr()->error(__('main.something_went_wrong'));
            $this->logError('Library creation failed', $e);
            return redirect()->back()->withInput();
        }
    }

    public function show(Library $library)
    {
        $library->load('grade', 'classroom', 'section', 'subject', 'user', 'attachments');

        return view('libraries.show', compact('library'));
    }

    public function edit(Library $library)
    {
        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $grade_id   = old('grade_id', $library->grade_id);
        $classrooms = Classroom::where('grade_id', $grade_id)->get();
        $sections   = Section::where('classroom_id', old('classroom_id', $library->classroom_id))->get();
        $library->load('attachments');

        return view('libraries.edit', compact('library', 'grades', 'subjects', 'classrooms', 'sections'));
    }

    public function update(LibraryRequest $request, Library $library)
    {
        try {
            $this->libraryService->update($request->validated(), $library);
            toastr()->success(__('main.updated_successfully'));

            return redirect()->route('libraries.index');
        } catch (\Exception $e) {
            toastr()->error(__('main.something_went_wrong'));
            $this->logError('Library update failed', $e);
            return redirect()->back()->withInput();
        }
    }

     public function destroy(Library $library)
     {
         try {
             $this->libraryService->delete($library);
             toastr()->success(__('main.deleted_successfully'));

             return redirect()->route('libraries.index');
         } catch (\Exception $e) {
             toastr()->error(__('main.something_went_wrong'));
             $this->logError('Library deletion failed', $e);
             return redirect()->back();
         }
     }
}
