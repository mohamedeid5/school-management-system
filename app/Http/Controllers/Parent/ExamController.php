<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Exam;

class ExamController extends Controller
{
    public function index()
    {
        $parent   = auth()->user()->parent;
        $children = $parent->children()->with('user')->get();

        $gradeIds = $children->pluck('grade_id')->unique();
        $classroomIds = $children->pluck('classroom_id')->unique();

        $allExams = Exam::whereIn('grade_id', $gradeIds)
                        ->whereIn('classroom_id', $classroomIds)
                        ->get();

        $children->each(function($child) use ($allExams) {
            $child->exams = $allExams->where('grade_id', $child->grade_id)
                                ->where('classroom_id', $child->classroom_id);
        });

        return view('parent.exams.index', compact('parent', 'children'));
    }
}
