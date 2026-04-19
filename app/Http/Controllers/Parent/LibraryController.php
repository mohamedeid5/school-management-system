<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Library;

class LibraryController extends Controller
{
    public function index()
    {
        $parent   = auth()->user()->parent;
        $children = $parent->children()->with('user')->get();

        $gradeIds = $children->pluck('grade_id')->unique();
        $classroomIds = $children->pluck('classroom_id')->unique();
        $sectionIds = $children->pluck('section_id')->unique();

        $allLibraries = Library::whereIn('grade_id', $gradeIds)
                        ->whereIn('classroom_id', $classroomIds)
                        ->whereIn('section_id', $sectionIds)
                        ->get();

        $children->each(function ($child) use ($allLibraries) {
            $child->libraries = $allLibraries->where('grade_id', $child->grade_id)
                    ->where('classroom_id', $child->classroom_id)
                    ->where('section_id', $child->section_id);
        });

        return view('parent.libraries.index', compact('children'));
    }
}
