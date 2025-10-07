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
    public function run(): void
    {
        // 1️⃣ Permissions
        $permissions = [
            ['name' => 'manage-teacher', 'display_name' => 'Manage Teachers'],
            ['name' => 'add-student', 'display_name' => 'Add Students'],
            ['name' => 'view', 'display_name' => 'View Records'],
            ['name' => 'edit', 'display_name' => 'Edit Records'],
            ['name' => 'delete', 'display_name' => 'Delete Records'],
            ['name' => 'view-student', 'display_name' => 'View Student Profile'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm['name']], $perm);
        }

        // 2️⃣ Roles
        $roles = [
            ['name'=>'admin','display_name'=>'Administrator','description'=>'Full access','permissions'=>['manage-teacher','add-student','view','edit','delete','view-student']],
            ['name'=>'teacher','display_name'=>'Teacher','description'=>'Can manage students','permissions'=>['add-student','view','edit','delete','view-student']],
            ['name'=>'student','display_name'=>'Student','description'=>'Can view own profile','permissions'=>['view-student']],
        ];

        foreach($roles as $r){
            $role = Role::firstOrCreate(['name'=>$r['name']], ['display_name'=>$r['display_name'],'description'=>$r['description']]);
            $permissionIds = Permission::whereIn('name',$r['permissions'])->pluck('id');
            $role->permissions()->sync($permissionIds);
        }

        // 3️⃣ Admin user
        $adminUser = User::firstOrCreate(['email'=>'admin@example.com'], ['name'=>'Admin User','password'=>Hash::make('password')]);
        $adminRole = Role::where('name','admin')->first();
        if(!$adminUser->roles()->where('role_id',$adminRole->id)->exists()){
            $adminUser->roles()->attach($adminRole);
        }

      // Create teacher user
$teacherUser = User::firstOrCreate(
    ['email' => 'teacher@example.com'],
    [
        'name' => 'Teacher User',
        'password' => Hash::make('password'),
    ]
);

// Attach teacher role
$teacherRole = Role::where('name','teacher')->first();
if (!$teacherUser->roles()->where('role_id', $teacherRole->id)->exists()) {
    $teacherUser->roles()->attach($teacherRole);
}

// Create teacher record
Teacher::firstOrCreate(
    ['user_id' => $teacherUser->id],
    ['subject' => 'Mathematics']
);

// Create student user
$studentUser = User::firstOrCreate(
    ['email' => 'student@example.com'],
    [
        'name' => 'Student User',
        'password' => Hash::make('password'),
    ]
);

// Attach student role
$studentRole = Role::where('name','student')->first();
if (!$studentUser->roles()->where('role_id', $studentRole->id)->exists()) {
    $studentUser->roles()->attach($studentRole);
}

// Create student record
Student::firstOrCreate(
    ['user_id' => $studentUser->id],
    ['grade' => '10']
);
    }
}
