<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name','email','password'];

   public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
   // ✅ Check if user has a specific role
    // public function hasRole($role)
    // {
    //     return $this->roles()->where('name', $role)->exists();
    // }

    // ✅ Check if user has a specific permission (through roles)
    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->where('name', $permission)->isNotEmpty()) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
{
   
    return $this->roles()->where('name', $role)->exists();
}

// public function hasPermission($permission)
// {
    
//     foreach ($this->roles as $role) {
      
//         foreach ($role->permissions as $perm) {
            
//             if ($perm->name === $permission) {
               
//                 return true;
//             }
//         }
//     }
   
//     return false;
// }

}
