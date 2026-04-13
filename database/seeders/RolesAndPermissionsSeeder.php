<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'access admin dashboard', 'access teacher dashboard',
            'access student dashboard', 'access parent dashboard',
            'view students', 'create students', 'update students', 'delete students',
            'view teachers', 'create teachers', 'update teachers', 'delete teachers',
            'view classes', 'create classes', 'update classes', 'delete classes',
            'view grades', 'create grades', 'update grades', 'delete grades',
            'view parents', 'create parents', 'update parents', 'delete parents',
            'view subjects', 'create subjects', 'update subjects', 'delete subjects',
            'manage settings'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        $teacher = Role::firstOrCreate(['name' => 'teacher']);
        $teacher->syncPermissions([
            'access teacher dashboard',
            'view students',
            'view classes',
            'view grades', 'create grades', 'update grades',
        ]);

        $student = Role::firstOrCreate(['name' => 'student']);
        $student->syncPermissions([
            'access student dashboard',
            'view grades',
            'view classes',
            'view subjects',
        ]);

        $parent = Role::firstOrCreate(['name' => 'parent']);
        $parent->syncPermissions([
            'access parent dashboard',
            'view students',
            'view grades',
            'view subjects',
        ]);
    }
}
