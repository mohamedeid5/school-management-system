<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Services\AttendanceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct(protected AttendanceService $attendanceService) {}

    public function index()
    {
        $user = Auth::user();

        $data = $this->attendanceService->getAttendanceIndexData($user);
        return view('admin.attendances.index', $data);
    }

    public function store(AttendanceRequest $request): RedirectResponse
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

    public function show($id): View
    {
        $students = $this->attendanceService->show($id);

        return view('admin.attendances.create', compact('students'));
    }

    public function edit(Attendance $attendance)
    {
        return view('admin.attendances.edit', compact('attendance'));
    }

}
