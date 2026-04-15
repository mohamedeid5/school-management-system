<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SectionController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Section::class);

        $teacher  = Auth::user()->teacher;
        $sections = $teacher
            ? $teacher->sections()->with(['grade', 'classroom'])->withCount('students')->get()
            : collect();

        return view('teacher.sections.index', compact('sections'));
    }

    public function show(Section $section)
    {
        Gate::authorize('view', $section);

        $section->load('grade', 'classroom', 'students.user');

        return view('teacher.sections.show', compact('section'));
    }
}
