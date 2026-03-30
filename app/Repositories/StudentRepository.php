<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function getAllStudents()
    {
        return Student::with(['user', 'grade', 'classroom', 'section', 'parent'])->get();
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
