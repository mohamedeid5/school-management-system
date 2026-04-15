<?php

namespace App\Http\Controllers\Student;

use App\Enums\AttendanceStatus;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $attendances = Attendance::where('student_id', $student->id)
            ->orderByDesc('attendance_date')
            ->get();

        $totalPresent = $attendances->where('attendance_status', AttendanceStatus::PRESENT)->count();
        $totalAbsent  = $attendances->where('attendance_status', AttendanceStatus::ABSENT)->count();
        $totalLate    = $attendances->where('attendance_status', AttendanceStatus::LATE)->count();
        $totalExcused = $attendances->where('attendance_status', AttendanceStatus::EXCUSED)->count();

        return view('student.attendances.index', compact(
            'attendances',
            'totalPresent',
            'totalAbsent',
            'totalLate',
            'totalExcused'
        ));
    }
}
