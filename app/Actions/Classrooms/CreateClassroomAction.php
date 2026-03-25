<?php

namespace App\Actions\Classrooms;

use App\Http\Requests\ClassroomRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;

class CreateClassroomAction
{
    public function handle(ClassroomRequest $request)
    {
        DB::transaction(function() use ($request) {
                foreach ($request->list_classrooms as $classroomData) {
                Classroom::create([
                    'name' => [
                        'ar' => $classroomData['name'],
                        'en' => $classroomData['name_en'],
                    ],
                    'grade_id' => $classroomData['grade_id'],
                ]);
            }
        });
    }
}
