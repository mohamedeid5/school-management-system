<?php

namespace App\Services;

use App\Enums\AttendanceStatus;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\FeeInvoice;
use App\Models\Library;
use App\Models\OnlineClass;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Models\Teacher;

class AdminDashboardService
{
    public function getDashboardStats(): array
    {
        return [
            'studentsCount'    => Student::count(),
            'teachersCount'    => Teacher::count(),
            'classroomsCount'  => Classroom::count(),
            'examsCount'       => Exam::count(),
            'libraryCount'     => Library::count(),
            'onlineClassCount' => OnlineClass::count(),

            'todayPresent' => Attendance::whereDate('attendance_date', today())
                ->where('attendance_status', AttendanceStatus::PRESENT)
                ->count(),
            'todayAbsent' => Attendance::whereDate('attendance_date', today())
                ->where('attendance_status', AttendanceStatus::ABSENT)
                ->count(),
            'todayLate' => Attendance::whereDate('attendance_date', today())
                ->where('attendance_status', AttendanceStatus::LATE)
                ->count(),
            'todayExcused' => Attendance::whereDate('attendance_date', today())
                ->where('attendance_status', AttendanceStatus::EXCUSED)
                ->count(),

            'totalInvoices' => FeeInvoice::sum('amount'),
            'totalPayments' => PaymentStudent::sum('amount'),

            'recentStudents' => Student::with('user', 'grade', 'classroom')
                ->latest()
                ->limit(6)
                ->get(),

            'recentInvoices' => FeeInvoice::with('student.user', 'fee')
                ->latest()
                ->limit(6)
                ->get(),
        ];
    }
}
