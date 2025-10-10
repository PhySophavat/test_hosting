<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Teacher;
use App\Models\Student;

class RolePermissionSeeder extends Seeder
{
    /**
     * Seed the database with roles, permissions, users, teachers, and students.
     * Ensures admin, teacher, and student users are created with appropriate roles
     * and linked to their respective tables for the school management system.
     *
     * @return void
     */
    public function run(): void
    {
        
        $permissions = [
            ['name' => 'manage-teacher', 'display_name' => 'Manage Teachers'], // Permission to create/edit/delete teachers
            ['name' => 'add-student', 'display_name' => 'Add Students'],       // Permission to create students
            ['name' => 'view', 'display_name' => 'View Records'],              // Permission to view records
            ['name' => 'edit', 'display_name' => 'Edit Records'],              // Permission to edit records
            ['name' => 'delete', 'display_name' => 'Delete Records'],          // Permission to delete records
            ['name' => 'view-student', 'display_name' => 'View Student Profile'], // Permission to view student profiles
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm['name']],
                ['display_name' => $perm['display_name']]
            );
        }
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full access to all features',
                'permissions' => ['manage-teacher', 'add-student', 'view', 'edit', 'delete', 'view-student'],
            ],
            [
                'name' => 'teacher',
                'display_name' => 'Teacher',
                'description' => 'Can manage student records and view profiles',
                'permissions' => ['add-student', 'view', 'edit', 'delete', 'view-student'],
            ],
            [
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'Can view own profile',
                'permissions' => ['view-student'],
            ],
        ];

        foreach ($roles as $r) {
            $role = Role::firstOrCreate(
                ['name' => $r['name']],
                ['display_name' => $r['display_name'], 'description' => $r['description']]
            );
            
            $permissionIds = Permission::whereIn('name', $r['permissions'])->pluck('id');
          
            $role->permissions()->sync($permissionIds);
        }

       
        // $adminUser = User::firstOrCreate(
        //     ['email' => 'admin@example.com'],
        //     ['name' => 'Admin User', 'password' => Hash::make('password')]
        // );
        // $adminRole = Role::where('name', 'admin')->first();
     
        // if ($adminRole && !$adminUser->roles()->where('role_id', $adminRole->id)->exists()) {
        //     $adminUser->roles()->attach($adminRole);
        // }

      
        // $teacherUser = User::firstOrCreate(
        //     ['email' => 'teacher@example.com'],
        //     ['name' => 'Teacher User', 'password' => Hash::make('password')]
        // );
        // $teacherRole = Role::where('name', 'teacher')->first();
        // if ($teacherRole && !$teacherUser->roles()->where('role_id', $teacherRole->id)->exists()) {
        //     $teacherUser->roles()->attach($teacherRole);
        // }
     
        // Teacher::firstOrCreate(
        //     ['user_id' => $teacherUser->id],
        //     ['subject' => 'Mathematics']
        // );

      
        // $studentUser = User::firstOrCreate(
        //     ['email' => 'student@example.com'],
        //     ['name' => 'Student User', 'password' => Hash::make('password')]
        // );
        // $studentRole = Role::where('name', 'student')->first();
        // if ($studentRole && !$studentUser->roles()->where('role_id', $studentRole->id)->exists()) {
        //     $studentUser->roles()->attach($studentRole);
        // }
        
        // Student::firstOrCreate(
        //     ['user_id' => $studentUser->id],
        //     ['grade' => '10']
        // );
    }
}