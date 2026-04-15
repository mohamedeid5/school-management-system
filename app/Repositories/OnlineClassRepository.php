<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\OnlineClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class OnlineClassRepository
{
    public function getIndexData(): array
    {
        $user = Auth::user();

        $onlineClasses = OnlineClass::authorizedForUser($user)->with('grade', 'classroom', 'user')->latest()->get();

        return [
            'onlineClasses' => $onlineClasses,
            'grades'        => Grade::all(),
        ];
    }

    public function getCreateData(): array
    {
        return [
            'grades'    => Grade::with('classrooms')->get(),
            'subjects'  => Subject::all(),
            'teachers'  => Teacher::all(),
            'classrooms'=> Classroom::where('grade_id', old('grade_id'))->get(),
        ];
    }

    public function store(array $data): OnlineClass
    {
        return OnlineClass::create($data);
    }

    public function update(OnlineClass $onlineClass, array $data): OnlineClass
    {
        $onlineClass->update($data);

        return $onlineClass;
    }

    public function delete(OnlineClass $onlineClass): void
    {
        $onlineClass->delete();
    }
}
