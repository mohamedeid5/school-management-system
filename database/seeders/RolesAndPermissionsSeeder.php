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
            'view students', 'view own students', 'create students', 'update students', 'delete students',
            'view teachers', 'create teachers', 'update teachers', 'delete teachers',
            'view classes', 'view own classes', 'create classes', 'update classes', 'delete classes',
            'view grades', 'view own grades', 'create grades', 'update grades', 'delete grades',
            'view classrooms', 'create classrooms', 'update classrooms', 'delete classrooms',
            'view sections', 'view own sections', 'create sections', 'update sections', 'delete sections',
            'view parents', 'view own parents', 'create parents', 'update parents', 'delete parents',
            'view subjects', 'view own subjects', 'create subjects', 'update subjects', 'delete subjects',
            'view libraries', 'view own libraries', 'create library', 'edit library', 'update library', 'delete library',
            'view online classes', 'view own online classes', 'create online classes', 'update online classes', 'delete online classes',
            'view exams', 'view own exams', 'create exams', 'edit exams', 'update exams', 'delete exams',
            'view questions', 'view own questions', 'create questions', 'edit questions', 'update questions', 'delete questions',
            'view attendance', 'create attendance',
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
            'view own students',
            'view own classes', 'create classes', 'update classes', 'delete classes',
            'view grades', 'create grades', 'update grades',
            'view own subjects', 'create subjects', 'update subjects',
            'view own online classes', 'create online classes', 'update online classes', 'delete online classes',
            'view libraries', 'create library', 'edit library', 'update library', 'delete library',
            'view own exams', 'edit exams', 'create exams', 'update exams', 'delete exams',
            'view own questions', 'edit questions', 'create questions', 'update questions', 'delete questions',
            'view own sections',
            'view attendance', 'create attendance',
        ]);

        $student = Role::firstOrCreate(['name' => 'student']);
        $student->syncPermissions([
            'access student dashboard',
            'view grades',
            'view classes',
            'view subjects',
            'view own libraries',
            'view own online classes',
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
