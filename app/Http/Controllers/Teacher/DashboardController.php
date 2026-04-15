<?php

namespace App\Http\Controllers\Teacher;

use App\Enums\AttendanceStatus;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\OnlineClass;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher    = auth()->user()->teacher;
        $sectionIds = $teacher ? $teacher->sections()->pluck('sections.id') : collect();

        $sectionsCount    = $sectionIds->count();
        $studentsCount    = Student::whereIn('section_id', $sectionIds)->count();
        $onlineClassCount = OnlineClass::where('user_id', auth()->id())->count();
        $examsCount       = auth()->user()->teacher->exams()->count();

        $todayPresent = Attendance::whereIn('section_id', $sectionIds)
            ->whereDate('attendance_date', today())
            ->where('attendance_status', AttendanceStatus::PRESENT)->count();
        $todayAbsent = Attendance::whereIn('section_id', $sectionIds)
            ->whereDate('attendance_date', today())
            ->where('attendance_status', AttendanceStatus::ABSENT)->count();
        $todayLate = Attendance::whereIn('section_id', $sectionIds)
            ->whereDate('attendance_date', today())
            ->where('attendance_status', AttendanceStatus::LATE)->count();
        $todayExcused = Attendance::whereIn('section_id', $sectionIds)
            ->whereDate('attendance_date', today())
            ->where('attendance_status', AttendanceStatus::EXCUSED)->count();

        $mySections = $teacher
            ? $teacher->sections()->with(['grade', 'classroom'])->withCount('students')->get()
            : collect();

        $recentStudents = Student::with('user', 'grade', 'classroom')
            ->whereIn('section_id', $sectionIds)
            ->latest()
            ->limit(8)
            ->get();

        $recentOnlineClasses = OnlineClass::with('subject', 'grade', 'classroom')
            ->where('user_id', auth()->id())
            ->latest()
            ->limit(5)
            ->get();

        return view('teacher.dashboard', compact(
            'teacher',
            'sectionsCount', 'studentsCount', 'onlineClassCount', 'examsCount',
            'todayPresent', 'todayAbsent', 'todayLate', 'todayExcused',
            'mySections', 'recentStudents', 'recentOnlineClasses'
        ));
    }
}
