<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'ar' => 'المرحلة الأولى',
                'en' => 'First Grade',
            ],
            [
                'ar' => 'المرحلة الثانية',
                'en' => 'Second Grade',
            ],
            [
                'ar' => 'المرحلة الثالثة',
                'en' => 'Third Grade',
            ]
        ];

        foreach ($grades as $grade) {
            Grade::create([
                'name' => $grade,
            ]);
        }
    }
}
