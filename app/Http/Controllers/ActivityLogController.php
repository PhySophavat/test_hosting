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
     */
    public static function log($action, $description,)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            // 'model_type' => $modelType,
            // 'model_id' => $modelId,
            'ip_address' => request()->ip(),
        ]);
    }
}