<?php

namespace App\Http\Controllers\Attendances;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Services\AttendanceService;
use App\Models\Student;

class AttendanceController extends Controller
{
    public function __construct(protected AttendanceService $attendanceService) {}

    public function index()
    {
        $data = $this->attendanceService->getAttendanceIndexData();
        return view('attendances.index', $data);
    }

    public function store(AttendanceRequest $request)
    {
        try {
            $this->attendanceService->createAttendance($request);
            toastr()->success(__('main.created_successfully'));

            return redirect()->route('attendances.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->logError('Attendance creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function show($id)
    {
        $students = Student::with(['grade', 'section', 'attendances' => function($query) {
            $query->where('attendance_date', date('Y-m-d'));
        }])->where('section_id', $id)->get();
        return view('attendances.create', compact('students'));
    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

}
