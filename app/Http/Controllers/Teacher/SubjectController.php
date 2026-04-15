<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Support\Facades\Gate;

class SubjectController extends Controller
{
    public function __construct(protected SubjectService $subjectService) {}

    public function index()
    {
        Gate::authorize('viewAny', Subject::class);

        $data = $this->subjectService->getSubjectIndexData();

        return view('teacher.subjects.index', $data);
    }

    public function show(Subject $subject)
    {
        Gate::authorize('view', $subject);

        $subject->load('grade', 'classroom', 'teacher');

        return view('teacher.subjects.show', compact('subject'));
    }
}
