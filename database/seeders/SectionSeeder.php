<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $sections = [
                [
                    'ar' => 'القسم الأول',
                    'en' => 'First Section',
                ],
                [
                    'ar' => 'القسم الثاني',
                    'en' => 'Second Section',
                ],
                [
                    'ar' => 'القسم الثالث',
                    'en' => 'Third Section',
                ]
            ];

            foreach ($sections as $section) {
                Section::create([
                    'name' => $section,
                    'classroom_id' => rand(1, 6),
                ]);
            }
    }
}
