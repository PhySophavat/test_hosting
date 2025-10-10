<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class PermissionMiddleware
// {
//     public function handle(Request $request, Closure $next, ...$permissions)
//     {
//         $user = Auth::user();

//         // ពិនិត្យថាតើអ្នកប្រើមានសិទ្ធិណាមួយក្នុងចំណោមសិទ្ធិដែលបានបញ្ជាក់
//         foreach ($permissions as $permission) {
//             if ($user->hasPermission($permission)) {
//                 return $next($request);
//             }
//         }

//         // បើអ្នកប្រើមិនមានសិទ្ធិទេ ប្តូរទៅទំព័រ 403 (Forbidden)
//         abort(403, 'អ្នកមិនមានសិទ្ធិចូលទៅកាន់ទំព័រនេះ។');
//     }
// }