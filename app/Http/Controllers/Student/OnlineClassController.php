<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\OnlineClass;
use App\Services\OnlineClassService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OnlineClassController extends Controller
{

    public function __construct(protected OnlineClassService $onlineClassService) {}

    public function index()
    {
        Gate::authorize('viewAny', OnlineClass::class);

        $user = Auth::user();

        $data = $this->onlineClassService->getIndexData($user);

        return view('student.online_classes.index', $data);
    }

    public function show(OnlineClass $onlineClass)
    {
        Gate::authorize('view', $onlineClass);

        $student = Auth::user()->student;

        if (
            $onlineClass->grade_id !== $student->grade_id ||
            $onlineClass->classroom_id !== $student->classroom_id
        ) {
            abort(403);
        }

        $onlineClass->load('subject', 'grade', 'classroom', 'user');

        return view('student.online_classes.show', compact('onlineClass'));
    }
}
