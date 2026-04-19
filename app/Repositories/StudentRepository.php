<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class StudentRepository
{
    public function getAllStudents()
    {
        $user = Auth::user();

        $studentCacheKey = 'students_for_user_' . $user->id;

        return Cache::remember($studentCacheKey, 3600, function() use ($user) {
            return Student::authorizedForUser($user)
                    ->with(['user', 'grade', 'classroom', 'section', 'parent', 'nationality', 'studentAccounts'])
                    ->get();
        });
    }

    public function createStudent($data, $userId, $studentCode)
    {
        return Student::create([
            'user_id' => $userId,
            'student_code' => $studentCode,
            'date_of_birth' => $data['date_of_birth'],
            'joining_date' => $data['joining_date'],
            'gender' => $data['gender'],
            'parent_id' => $data['parent_id'],
            'grade_id' => $data['grade_id'],
            'classroom_id' => $data['classroom_id'],
            'section_id' => $data['section_id'],
            'nationality_id' => $data['nationality_id'],
            'blood_type_id' => $data['blood_type_id'],
            'academic_year' => $data['academic_year']
        ]);
    }

    public function updateStudent($data, $student)
    {
        return $student->update([
            'date_of_birth' => $data['date_of_birth'],
            'joining_date' => $data['joining_date'],
            'gender' => $data['gender'],
            'parent_id' => $data['parent_id'],
            'grade_id' => $data['grade_id'],
            'classroom_id' => $data['classroom_id'],
            'section_id' => $data['section_id'],
            'nationality_id' => $data['nationality_id'],
            'blood_type_id' => $data['blood_type_id'],
            'academic_year' => $data['academic_year']
        ]);
    }

    public function deleteStudent($student)
    {
        return $student->delete();
    }
}
