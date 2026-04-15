<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $parent   = auth()->user()->parent;
        $children = $parent
            ? $parent->children()->with(['user', 'grade', 'classroom', 'section'])->get()
            : collect();

        $children->each(function ($child) {
            $child->subjects = Subject::with('teacher.user')
                ->where('grade_id',     $child->grade_id)
                ->where('classroom_id', $child->classroom_id)
                ->get();
        });

        return view('parent.dashboard', compact('parent', 'children'));
    }
}
