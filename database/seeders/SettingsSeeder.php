<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();

        $settings = [
            ['key' => 'school_name', 'value' => 'My School'],
            ['key' => 'school_address', 'value' => '123 Main St, City, Country'],
            ['key' => 'school_phone', 'value' => '+1234567890'],
            ['key' => 'school_email', 'value' => 'info@myschool.com'],
            ['key' => 'school_logo', 'value' => 'logo.png'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
