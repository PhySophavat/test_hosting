<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     */
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        return view('activity_logs.index', compact('logs'));
    }

    /**
     * Log an activity.
     *
     * @param string $action
     * @param string $description
     * @param array|null $oldValues
     * @param array|null $newValues
     */
public static function log($action, $description, $oldValues = null, $newValues = null)
{
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => $action,
        'description' => $description,
        'old_values' => $oldValues ? json_encode($oldValues, JSON_UNESCAPED_UNICODE) : null,
        'new_values' => $newValues ? json_encode($newValues, JSON_UNESCAPED_UNICODE) : null,
        'ip_address' => request()->ip(),
        'user_agent' => request()->header('User-Agent'),
    ]);
}


}
