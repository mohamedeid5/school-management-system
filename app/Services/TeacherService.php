<?php

namespace App\Services;

use App\Models\Teacher;
use App\Repositories\TeacherRepository;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherService {

    public TeacherRepository $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function getIndexPageData() {
        return $this->teacherRepository->getAllTeachers();
    }

    public function getCreatePageData() {
        return [
            'specializations' => $this->teacherRepository->getAllSpecializations(),
            'sections' => $this->teacherRepository->getAllSections(),
        ];
    }

    public function storeTeacher(array $data) {

        DB::transaction(function() use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $user->assignRole('teacher');

            $data['user_id'] = $user['id'];
            $this->teacherRepository->createTeacher($data);
        });
    }

    public function getTeacherById($id) {
        return $this->teacherRepository->findTeacherById($id);
    }

    public function getEditPageData(Teacher $teacher) {
        $teacher->load('user', 'specialization', 'sections');

        return [
            'teacher' => $teacher,
            'specializations' => $this->teacherRepository->getAllSpecializations(),
            'sections' => $this->teacherRepository->getAllSections(),
        ];
    }

    public function updateTeacher(array $data, $teacher) {

        DB::transaction(function() use ($data, $teacher) {

            $teacher->load('user');
            $user = $teacher->user;
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
            ];

            if (!empty($data['password'])) {
                $userData['password'] =  Hash::make($data['password']);
            }

            $user->update($userData);
            $this->teacherRepository->updateTeacher($data, $teacher);

        });
    }

    public function deleteTeacher($teacher) {
        DB::transaction(function() use ($teacher) {
            $user = $teacher->user;
            $this->teacherRepository->deleteTeacher($teacher);
            $user->delete();
        });

    }
}
