<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'status',
        'admin_note',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Relationship: Permission request belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Reviewed by admin
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the Khmer translation for permission type
     */
    public function getTypeKhmerAttribute()
    {
        $types = [
            'annual_leave' => 'ច្បាប់ប្រចាំឆ្នាំ',
            'sick_leave' => 'ច្បាប់ឈឺ',
            'personal_leave' => 'ច្បាប់ផ្ទាល់ខ្លួន',
            'unpaid_leave' => 'ច្បាប់គ្មានប្រាក់បៀវត្សរ៍',
        ];

        return $types[$this->type] ?? $this->type;
    }

    /**
     * Get the status color for UI
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
            'approved' => 'bg-green-100 text-green-800 border-green-300',
            'rejected' => 'bg-red-100 text-red-800 border-red-300',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
    }
}