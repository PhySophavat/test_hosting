<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        return view('activity_logs.index', compact('logs'));
    }

   
public static function log($action, $description, $oldValues = null, $newValues = null)
{
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => $action,
        'description' => $description,
        'old_values' => $oldValues,
        'new_values' => $newValues,
        'ip_address' => request()->ip(),
        'user_agent' => request()->header('User-Agent'),
    ]);
}


}
