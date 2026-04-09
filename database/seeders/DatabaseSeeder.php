<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            BloodTypeSeeder::class,
            NationalitySeeder::class,
            ReligionSeeder::class,
            SpecializationSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            GradeSeeder::class,
            ClassroomSeeder::class,
            SectionSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
