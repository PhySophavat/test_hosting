<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'grade'];

   // All scores for this student
public function subjects()
{
    return $this->hasMany(Subject::class);
}
 public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

// Latest score record (for pre-fill)
public function latestSubject()
{
    return $this->hasOne(Subject::class)->latestOfMany();
}


     public function user()
    {
        return $this->belongsTo(User::class); // user_id in students table
    }
}
