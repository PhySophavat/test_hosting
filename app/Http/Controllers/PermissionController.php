<?php

namespace App\Http\Controllers;

use App\Models\PermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of permission requests
     */
    public function index()
    {
        // Show all requests for all users
        $requests = PermissionRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $pendingCount = PermissionRequest::where('status', 'pending')->count();
        $isAdmin = true; // Everyone can manage requests
        
        return view('permission.index', compact('requests', 'isAdmin', 'pendingCount'));
    }

    /**
     * Show the form for creating a new permission request
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created permission request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:annual_leave,sick_leave,personal_leave,unpaid_leave',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
        ]);

        $startDate = new \DateTime($validated['start_date']);
        $endDate = new \DateTime($validated['end_date']);
        $totalDays = $startDate->diff($endDate)->days + 1;

        PermissionRequest::create([
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_days' => $totalDays,
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('permission.index')
            ->with('success', 'សំណើច្បាប់ត្រូវបានបង្កើតដោយជោគជ័យ / Permission request created successfully');
    }

    /**
     * Display the specified permission request
     */
    public function show(PermissionRequest $permission)
    {
        return view('permission.show', compact('permission'));
    }

    /**
     * Approve a permission request
     */
    public function approve(Request $request, PermissionRequest $permission)
    {
        $permission->update([
            'status' => 'approved',
            'admin_note' => $request->admin_note,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('permission.index')
            ->with('success', 'សំណើច្បាប់ត្រូវបានអនុម័ត / Permission request approved');
    }

    /**
     * Reject a permission request
     */
    public function reject(Request $request, PermissionRequest $permission)
    {
        $request->validate([
            'admin_note' => 'required|string|max:500',
        ]);

        $permission->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('permission.index')
            ->with('success', 'សំណើច្បាប់ត្រូវបានបដិសេធ / Permission request rejected');
    }

    /**
     * Cancel a pending permission request
     */
    public function cancel(PermissionRequest $permission)
    {
        // Check if it's still pending
        if ($permission->status !== 'pending') {
            abort(403, 'Cannot cancel this request');
        }

        $permission->delete();

        return redirect()->route('permission.index')
            ->with('success', 'សំណើច្បាប់ត្រូវបានលុបចោល / Permission request cancelled');
    }
}