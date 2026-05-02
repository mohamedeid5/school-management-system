<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'email' => 'mohamed@gmail.com',
        ], [
            'name' => 'mohamed eid',
            'password' => Hash::make('mohamedeid')
        ]);

        $user->assignRole('admin');
    }
}
