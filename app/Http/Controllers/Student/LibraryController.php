<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Services\LibraryService;

class LibraryController extends Controller
{
    public function __construct(protected LibraryService $libraryService) {}

    public function index()
    {
        Gate::authorize('viewAny', Library::class);

        $user = Auth::user();

        $data = $this->libraryService->getIndexData($user);

        return view('student.libraries.index', $data);
    }

    public function show(Library $library)
    {
        Gate::authorize('view', $library);

        $student = Auth::user()->student;

        if (
            $library->grade_id !== $student->grade_id ||
            $library->classroom_id !== $student->classroom_id
        ) {
            abort(403);
        }

        $library->load('grade', 'classroom', 'section', 'subject', 'user', 'attachments');

        return view('student.libraries.show', compact('library'));
    }
}
