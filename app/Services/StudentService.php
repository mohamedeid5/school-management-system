<?php

namespace App\Services;

use App\Models\MyParent;
use App\Repositories\StudentRepository;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use App\Models\Nationality;
use App\Models\BloodType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentService
{

    public StudentRepository $studentRepository;
    public FileService $fileUploadService;

    public function __construct(StudentRepository $studentRepository, FileService $fileUploadService)
    {
        $this->studentRepository = $studentRepository;
        $this->fileUploadService = $fileUploadService;
    }

    public function getAllStudents()
    {
        return $this->studentRepository->getAllStudents();
    }

    public function getCreatePageData()
    {
        $classrooms = old('grade_id')
                ? Classroom::where('grade_id', old('grade_id'))->get()
                : Classroom::all();

        $sections = old('classroom_id')
                ? Section::where('classroom_id', old('classroom_id'))->get()
                : Section::all();

        return [
            'parents' => MyParent::all(),
            'grades' => Grade::all(),
            'classrooms' => $classrooms,
            'sections' => $sections,
            'nationalities' => Nationality::all(),
            'bloodTypes' => BloodType::all(),
        ];
    }

    public function storeStudent($data)
    {
        DB::transaction(function() use ($data) {

            $studentCode = $this->generateStudentCode();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $user->assignRole('student');

           $student = $this->studentRepository->createStudent($data, $user->id, $studentCode);

           if (request()->hasFile('photos')) {
                $this->fileUploadService->upload(
                    request()->file('photos'),
                    $student,
                    'students',
                );
            }
        });
    }

    public function generateStudentCode()
    {
        $year = date('Y');

        $lastStudent = Student::whereYear('created_at', $year)
                ->lockForUpdate()
                ->latest('id')
                ->withTrashed()
                ->first();

        $nextStudent = $lastStudent ? (int) substr($lastStudent->student_code, -4) + 1 : 1;

        return $year . str_pad($nextStudent, 4, '0', STR_PAD_LEFT);
    }

    public function getEditPageData($student)
    {
        $gradeId = old('grade_id', $student->grade_id);
        $classroomId = old('classroom_id', $student->classroom_id);

        return [
            'student' => $student->load('user'),
            'parents' => MyParent::all(),
            'grades' => Grade::all(),
            'classrooms' => Classroom::where('grade_id', $gradeId)->get(),
            'sections' => Section::where('classroom_id', $classroomId)->get(),
            'nationalities' => Nationality::all(),
            'bloodTypes' => BloodType::all(),
        ];
    }

    public function updateStudent($data, $student)
    {
        DB::transaction(function() use ($data, $student) {

            $user = $student->user;
            $userData = [
                'name' => $data['name'],
                'email' => $data['email']
            ];

            if (!empty($data['password'])) {
                $student->user->update([
                    'password' => Hash::make($data['password'])
                ]);
            }
            $user->update($userData);
            $this->studentRepository->updateStudent($data, $student);

            if (request()->hasFile('photos')) {
                $this->fileUploadService->upload(
                    request()->file('photos'),
                    $student,
                    'students',
                );
            }
        });

    }

    public function deleteStudent($student)
    {
        DB::transaction(function() use ($student) {
            $student->user->delete();
            return $this->studentRepository->deleteStudent($student);
        });
    }
}
