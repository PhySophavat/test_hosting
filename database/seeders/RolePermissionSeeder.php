<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            ['name' => 'manage-teacher', 'display_name' => 'Manage Teachers'],
            ['name' => 'add-student', 'display_name' => 'Add Students'],
            ['name' => 'view', 'display_name' => 'View Records'],
            ['name' => 'edit', 'display_name' => 'Edit Records'],
            ['name' => 'delete', 'display_name' => 'Delete Records'],
            ['name' => 'view-student', 'display_name' => 'View Student Profile'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        // Define roles and their permissions
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full system access',
                'permissions' => ['manage-teacher', 'add-student', 'view', 'edit', 'delete', 'view-student'],
            ],
            [
                'name' => 'teacher',
                'display_name' => 'Teacher',
                'description' => 'Can manage students',
                'permissions' => ['add-student', 'view', 'edit', 'delete', 'view-student'],
            ],
            [
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'Can view own profile',
                'permissions' => ['view-student'],
            ],
        ];

        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate(
                ['name' => $roleData['name']],
                [
                    'display_name' => $roleData['display_name'],
                    'description' => $roleData['description'],
                ]
            );

            $permissionIds = Permission::whereIn('name', $roleData['permissions'])->pluck('id');
            $role->permissions()->sync($permissionIds);
        }

        // Create admin user
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        if (!$adminUser->roles()->where('role_id', $adminRole->id)->exists()) {
            $adminUser->roles()->attach($adminRole);
        }

        // Create teacher user
        $teacherRole = Role::where('name', 'teacher')->first();
        $teacherUser = User::firstOrCreate(
            ['email' => 'teacher@example.com'],
            [
                'name' => 'Teacher User',
                'password' => Hash::make('password'),
            ]
        );
        if (!$teacherUser->roles()->where('role_id', $teacherRole->id)->exists()) {
            $teacherUser->roles()->attach($teacherRole);
            Teacher::create(['user_id' => $teacherUser->id, 'subject' => 'Mathematics']);
        }

        // Create student user
        $studentRole = Role::where('name', 'student')->first();
        $studentUser = User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Student User',
                'password' => Hash::make('password'),
            ]
        );
        if (!$studentUser->roles()->where('role_id', $studentRole->id)->exists()) {
            $studentUser->roles()->attach($studentRole);
            Student::create(['user_id' => $studentUser->id, 'grade' => '10']);
        }
    }
}