<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Section;
use App\Services\AttendanceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function __construct(protected AttendanceService $attendanceService) {}

    public function index()
    {
        Gate::authorize('viewAny', Attendance::class);

        $user   = Auth::user();

        $data = $this->attendanceService->getAttendanceIndexData($user);

        return view('teacher.attendances.index', $data);
    }

    public function show($id)
    {
        $section = Section::find($id);

        Gate::authorize('view', $section);

        $students = $this->attendanceService->show($id);

        return view('teacher.attendances.create', compact('students'));
    }

    public function store(AttendanceRequest $request)
    {
        try {
            $this->attendanceService->createAttendance($request);
            toastr()->success(__('main.created_successfully'));

            return redirect()->route('teacher.attendances.index');
        } catch (\Exception $e) {
            $this->logError('Attendance creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
