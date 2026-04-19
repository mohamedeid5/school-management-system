<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\OnlineClass;

class OnlineClassController extends Controller
{
    public function index()
    {
        $parent   = auth()->user()->parent;
        $children = $parent
            ? $parent->children()->with('user')->get()
            : collect();


        $gradeIds = $children->pluck('grade_id')->unique();
        $classroomIds = $children->pluck('classroom_id')->unique();

        $allOnlineClasses = OnlineClass::whereIn('grade_id', $gradeIds)
                        ->whereIn('classroom_id', $classroomIds)
                        ->get();

        $children->each(function ($child) use ($allOnlineClasses) {
            $child->onlineClasses = $allOnlineClasses->where('grade_id', $child->grade_id)
                    ->where('classroom_id', $child->classroom_id);
        });

        return view('parent.online_classes.index', compact('children'));
    }
}
