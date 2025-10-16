<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grade',
        'date_of_birth',
        'gender',
        'village',
        'commune',
        'district',
        'province',
        'phone',
        'high_school',
        'mother_name',
        'mother_phone',
        'father_name',
        'father_phone',
    ];

    // All scores for this student
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    // Latest score record (for pre-fill)
    public function latestSubject()
    {
        return $this->hasOne(Subject::class)->latestOfMany();
    }

    // Belongs to a user account
    public function user()
    {
        return $this->belongsTo(User::class); // user_id in students table
    }

    // Optional: belongs to class
    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
}
