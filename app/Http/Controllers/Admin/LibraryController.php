<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Section;
use App\Models\Subject;
use App\Services\LibraryService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function __construct(protected LibraryService $libraryService) {}

    public function index()
    {
        $user = Auth::user();

        Gate::authorize('viewAny', Library::class);

        $data = $this->libraryService->getIndexData($user);

        return view('admin.libraries.index', $data);
    }

    public function create()
    {
        Gate::authorize('create', Library::class);

        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $classrooms = Classroom::where('grade_id', old('grade_id'))->get();
        $sections   = Section::where('classroom_id', old('classroom_id'))->get();

        return view('admin.libraries.create', compact('grades', 'subjects', 'classrooms', 'sections'));
    }

    public function store(LibraryRequest $request)
    {
        try {

            $data = $request->validated();

            $data['user_id'] = Auth::id();

            $this->libraryService->create($data);
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
        Gate::authorize('view', $library);

        $library->load('grade', 'classroom', 'section', 'subject', 'user', 'attachments');

        return view('admin.libraries.show', compact('library'));
    }

    public function edit(Library $library)
    {
        Gate::authorize('update', $library);

        $grades     = Grade::with('classrooms')->get();
        $subjects   = Subject::all();
        $grade_id   = old('grade_id')
                ? Classroom::where('grade_id', old('grade_id'))->get()
                : $library->grade_id;
        $classrooms = Classroom::where('grade_id', $grade_id)->get();
        $sections   = Section::where('classroom_id', old('classroom_id', $library->classroom_id))->get();
        $library->load('attachments');

        return view('admin.libraries.edit', compact('library', 'grades', 'subjects', 'classrooms', 'sections'));
    }

    public function update(LibraryRequest $request, Library $library)
    {
        Gate::authorize('update', $library);

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
         Gate::authorize('delete', $library);

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
