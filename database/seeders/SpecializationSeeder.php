<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->delete();

        $specializations = [
            ['en' => 'Arabic', 'ar' => 'اللغة العربية'],
            ['en' => 'English', 'ar' => 'اللغة الإنجليزية'],
            ['en' => 'Mathematics', 'ar' => 'الرياضيات'],
            ['en' => 'Science', 'ar' => 'العلوم'],
            ['en' => 'Social Studies', 'ar' => 'الدراسات الاجتماعية'],
            ['en' => 'Computer Science', 'ar' => 'الحاسب الآلي'],
            ['en' => 'Religion', 'ar' => 'التربية الدينية'],
            ['en' => 'Physical Education', 'ar' => 'التربية الرياضية'],
            ['en' => 'Art Education', 'ar' => 'التربية الفنية'],
        ];

        foreach ($specializations as $specialization) {
            Specialization::create([
                'name' => $specialization
            ]);
        }
    }
}
