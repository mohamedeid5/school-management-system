<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nationalities')->delete();

            $nationalities = [
            ['en'=> 'Egyptian', 'ar'=> 'مصري'],
            ['en'=> 'Saudi', 'ar'=> 'سعودي'],
            ['en'=> 'Emirati', 'ar'=> 'إماراتي'],
        ];

        foreach ($nationalities as $n) {
            Nationality::create(['name' => $n]);
        }
    }
}
