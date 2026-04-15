<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Support\Facades\Gate;
use App\Services\SectionService;

class SectionController extends Controller
{
    public function __construct(protected SectionService $sectionService) {}

    public function index()
    {
        Gate::authorize('viewAny', Section::class);

        $data = $this->sectionService->getIndexData();

        return view('teacher.sections.index', $data);
    }

    public function show(Section $section)
    {
        Gate::authorize('view', $section);

        $section->load('grade', 'classroom', 'students.user');

        return view('teacher.sections.show', compact('section'));
    }
}
