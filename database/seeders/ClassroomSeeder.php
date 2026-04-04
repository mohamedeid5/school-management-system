<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = [
            [
                'ar' => 'الصف الأول',
                'en' => 'First Grade',
            ],
            [
                'ar' => 'الصف الثاني',
                'en' => 'Second Grade',
            ],
            [
                'ar' => 'الصف الثالث',
                'en' => 'Third Grade',
            ],
             [
                'ar' => 'الصف الرابع',
                'en' => 'Fourth Grade',
            ],
             [
                'ar' => 'الصف الخامس',
                'en' => 'Fifth Grade',
            ],
             [
                'ar' => 'الصف السادس',
                'en' => 'Sixth Grade',
            ]
        ];

        foreach ($classrooms as $classroom) {
            Classroom::create([
                'name' => $classroom,
                'grade_id' => rand(1, 3),
            ]);
        }
    }
}
