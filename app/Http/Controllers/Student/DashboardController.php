<?php

namespace App\Http\Controllers\Student;

use App\Enums\AttendanceStatus;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Exam;
use App\Models\FeeInvoice;
use App\Models\OnlineClass;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $subjects = Subject::with('teacher.user')
            ->where('grade_id',     $student->grade_id)
            ->where('classroom_id', $student->classroom_id)
            ->get();

        $upcomingExams = Exam::with('subject', 'teacher.user')
            ->where('grade_id',     $student->grade_id)
            ->where('classroom_id', $student->classroom_id)
            ->where('exam_date', '>=', now())
            ->orderBy('exam_date')
            ->limit(6)
            ->get();

        $onlineClasses = OnlineClass::with('subject', 'user')
            ->where('grade_id',     $student->grade_id)
            ->where('classroom_id', $student->classroom_id)
            ->latest()
            ->limit(5)
            ->get();

        $attendances  = Attendance::where('student_id', $student->id)->get();
        $totalPresent = $attendances->where('attendance_status', AttendanceStatus::PRESENT)->count();
        $totalAbsent  = $attendances->where('attendance_status', AttendanceStatus::ABSENT)->count();
        $totalLate    = $attendances->where('attendance_status', AttendanceStatus::LATE)->count();
        $totalExcused = $attendances->where('attendance_status', AttendanceStatus::EXCUSED)->count();

        $recentAttendances = Attendance::where('student_id', $student->id)
            ->orderByDesc('attendance_date')
            ->limit(10)
            ->get();

        $feeInvoices = FeeInvoice::with('fee')
            ->where('student_id', $student->id)
            ->latest()
            ->limit(6)
            ->get();

        return view('student.dashboard', compact(
            'student',
            'subjects',
            'upcomingExams',
            'onlineClasses',
            'totalPresent', 'totalAbsent', 'totalLate', 'totalExcused',
            'recentAttendances',
            'feeInvoices'
        ));
    }
}
