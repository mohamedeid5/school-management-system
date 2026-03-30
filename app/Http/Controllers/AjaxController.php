<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;

class AjaxController extends Controller
{
    public function getClassrooms($gradeId)
    {
        $classrooms = Classroom::where('grade_id', $gradeId)->pluck('name', 'id');
        return response()->json($classrooms);
    }

     public function getSections($classroomId)
    {
        $sections = Section::where('classroom_id', $classroomId)->pluck('name', 'id');
        return response()->json($sections);
    }
}
