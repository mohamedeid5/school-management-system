<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class AttendanceRepository
{
    public function getAttendanceIndexData($user)
    {
        $grades = Grade::authorizedForUser($user)->get();

        return [
            'grades' => $grades,
        ];
    }

    public function show($id)
    {
        return Student::with(['grade', 'classroom', 'section', 'attendances' => function ($query) {
            $query->where('attendance_date', date('Y-m-d'));
        }])->where('section_id', $id)->get();
    }

    public function create($data)
    {
        return DB::transaction(function () use ($data) {

            foreach($data->attendance_status as $id => $status) {

                Attendance::updateOrCreate(
                    [
                        'student_id'      => $id,
                        'attendance_date' => $data->attendance_date,
                    ],
                    [
                        'grade_id'          => $data->grade_id,
                        'classroom_id'      => $data->classroom_id,
                        'section_id'        => $data->section_id,
                        'user_id'           => Auth::id(),
                        'attendance_status' => $status,
                    ]
                );
            }

            return true;
        });
    }
}
