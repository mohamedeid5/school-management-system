<?php

namespace App\Http\Controllers\Parent;

use App\Enums\AttendanceStatus;
use App\Http\Controllers\Controller;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $parent   = auth()->user()->parent;
        $children = $parent->children()->with('user')->get();

        $allAttendances = Attendance::whereIn('student_id', $children->pluck('id'))->get();

        $children->each(function($child) use ($allAttendances) {
            $childAttendances = $allAttendances->where('student_id', $child->id);

            $child->attendances   = $childAttendances;
            $child->totalPresent = $childAttendances->where('attendance_status', AttendanceStatus::PRESENT)->count();
            $child->totalAbsent  = $childAttendances->where('attendance_status', AttendanceStatus::ABSENT)->count();
            $child->totalLate    = $childAttendances->where('attendance_status', AttendanceStatus::LATE)->count();
            $child->totalExcused = $childAttendances->where('attendance_status', AttendanceStatus::EXCUSED)->count();
        });

        return view('parent.attendances.index', compact('children'));
    }
}
