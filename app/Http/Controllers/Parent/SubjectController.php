<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $parent   = auth()->user()->parent;
        $children = $parent->children()->with('user')->get();

        $gradeIds = $children->pluck('grade_id')->unique();
        $classroomIds = $children->pluck('classroom_id')->unique();

        $allSubjects = Subject::whereIn('grade_id', $gradeIds)
            ->whereIn('classroom_id', $classroomIds)
            ->get();

        $children->each(function($child) use ($allSubjects) {
            $child->subjects = $allSubjects->where('grade_id', $child->grade_id)
                                    ->where('classroom_id', $child->classroom_id);
        });

        return view('parent.subjects.index', compact('parent', 'children'));
    }
}
