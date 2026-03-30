<?php

namespace App\Repositories;

use App\Models\Specialization;
use App\Models\Teacher;
use App\Models\Section;

class TeacherRepository {


    public function getAllTeachers()
    {
        return Teacher::with('user', 'specialization', 'sections')->get();
    }

    public function getAllSpecializations()
    {
        return Specialization::all();
    }

    public function getAllSections()
    {
        return Section::all();
    }

    public function findTeacherById($id) {
        return Teacher::with('user', 'specialization', 'sections')->findOrFail($id);
    }

    public function createTeacher($data) {

        $teacher = Teacher::create([
            'user_id' => $data['user_id'],
            'specialization_id' => $data['specialization_id'],
            'gender' => $data['gender'],
            'joining_date' => $data['joining_date'],
            'address' => $data['address'],
        ]);

        $teacher->sections()->sync($data['section_ids'] ?? []);

        return $teacher;
    }

    public function updateTeacher($data, $teacher) {

        $teacher->update([
            'specialization_id' => $data['specialization_id'],
            'gender' => $data['gender'],
            'joining_date' => $data['joining_date'],
            'address' => $data['address'],
        ]);

        $teacher->sections()->sync($data['section_ids'] ?? []);

        return $teacher;
    }

    public function deleteTeacher(Teacher $teacher) {
        $teacher->delete();
        $teacher->sections()->detach();
    }
}
