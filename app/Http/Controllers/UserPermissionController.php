<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function edit(User $user)
    {
        $permissions = Permission::all();
        // $userPermissions = $user->permissions()->pluck('id')->toArray();

        return view('users.permissions.edit', compact('user', 'permissions', ));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Sync user permissions
        $user->permissions()->sync($request->permissions ?? []);

        return redirect()->route('users.index')
                         ->with('success', 'Permissions updated successfully!');
    }
}
