<?php

namespace App\Http\Controllers;

use App\Enums\AttendanceStatus;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\FeeInvoice;
use App\Models\Library;
use App\Models\OnlineClass;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;


class DashboardController extends Controller
{
    public function redirect()
    {
        $user = auth()->user();
        if ($user->hasRole('admin'))   return redirect()->route('admin.dashboard');
        if ($user->hasRole('teacher')) return redirect()->route('teacher.dashboard');
        if ($user->hasRole('parent'))  return redirect()->route('parent.dashboard');
        if ($user->hasRole('student')) return redirect()->route('student.dashboard');
        abort(403);
    }

    public function teacherDashboard()
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

        return view('teachers.dashboard.index', compact(
            'teacher',
            'sectionsCount', 'studentsCount', 'onlineClassCount', 'examsCount',
            'todayPresent', 'todayAbsent', 'todayLate', 'todayExcused',
            'mySections', 'recentStudents', 'recentOnlineClasses'
        ));
    }

    public function parentDashboard()
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

        return view('parents.dashboard.index', compact('parent', 'children'));
    }

    public function studentDashboard()
    {
        $student = auth()->user()->student;

        if (!$student) abort(403);

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

        $attendances = Attendance::where('student_id', $student->id)->get();
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

        return view('students.dashboard.index', compact(
            'student',
            'subjects',
            'upcomingExams',
            'onlineClasses',
            'totalPresent', 'totalAbsent', 'totalLate', 'totalExcused',
            'recentAttendances',
            'feeInvoices'
        ));
    }

    public function index()
    {

        $studentsCount    = Student::count();
        $teachersCount    = Teacher::count();
        $classroomsCount  = Classroom::count();
        $examsCount       = Exam::count();
        $libraryCount     = Library::count();
        $onlineClassCount = OnlineClass::count();

        $todayPresent = Attendance::whereDate('attendance_date', today())
            ->where('attendance_status', AttendanceStatus::PRESENT)
            ->count();
        $todayAbsent = Attendance::whereDate('attendance_date', today())
            ->where('attendance_status', AttendanceStatus::ABSENT)
            ->count();
        $todayLate = Attendance::whereDate('attendance_date', today())
            ->where('attendance_status', AttendanceStatus::LATE)
            ->count();
        $todayExcused = Attendance::whereDate('attendance_date', today())
            ->where('attendance_status', AttendanceStatus::EXCUSED)
            ->count();

        $totalInvoices = FeeInvoice::sum('amount');
        $totalPayments = PaymentStudent::sum('amount');

        $recentStudents = Student::with('user', 'grade', 'classroom')
            ->latest()
            ->limit(6)
            ->get();

        $recentInvoices = FeeInvoice::with('student.user', 'fee')
            ->latest()
            ->limit(6)
            ->get();

        return view('dashboard', compact(
            'studentsCount', 'teachersCount', 'classroomsCount', 'examsCount',
            'libraryCount', 'onlineClassCount',
            'todayPresent', 'todayAbsent', 'todayLate', 'todayExcused',
            'totalInvoices', 'totalPayments',
            'recentStudents', 'recentInvoices'
        ));
    }
}
