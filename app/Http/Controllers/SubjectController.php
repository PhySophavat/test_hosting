<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display all subjects/scores.
     */
    public function index()
    {
        // Check permission
        $user = Auth::user();
        if (!$user || (! $user->hasPermission('view-scores') &&
            ! $user->hasRole('teacher') &&
            ! $user->hasRole('admin'))) {
            abort(403, 'អ្នកមិនមានសិទ្ធិមើលពិន្ទុទេ។');
        }

        // Load all subjects with student and user relationships
        $subjects = Subject::with(['student.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new score for a student.
     */
    public function create($studentId)
    {
        // Check permission
        $user = Auth::user();
        if (!$user || (! $user->hasPermission('add-scores') &&
            ! $user->hasRole('teacher') &&
            ! $user->hasRole('admin'))) {
            abort(403, 'អ្នកមិនមានសិទ្ធិក្នុងការបញ្ចូលពិន្ទុទេ។');
        }

        $student = Student::with('user', 'latestSubject')->findOrFail($studentId);

        return view('subject.create', compact('student'));
    }

    /**
     * Store a new score record for a student.
     * Always creates a new record (never updates).
     */
    public function store(Request $request, $studentId)
    {
        // Check permission
        $user = Auth::user();
        if (!$user || (! $user->hasPermission('add-scores') &&
            ! $user->hasRole('teacher') &&
            ! $user->hasRole('admin'))) {
            return redirect()->back()->with('error', 'អ្នកមិនមានសិទ្ធិក្នុងការបញ្ចូលពិន្ទុទេ។');
        }

        $student = Student::findOrFail($studentId);

        // Validate input
        $validated = $request->validate([
            'math' => 'nullable|numeric|min:0|max:100',
            'khmer' => 'nullable|numeric|min:0|max:100',
            'english' => 'nullable|numeric|min:0|max:100',
            'history' => 'nullable|numeric|min:0|max:100',
            'geography' => 'nullable|numeric|min:0|max:100',
            'chemistry' => 'nullable|numeric|min:0|max:100',
            'physics' => 'nullable|numeric|min:0|max:100',
            'biology' => 'nullable|numeric|min:0|max:100',
            'morality' => 'nullable|numeric|min:0|max:100',
            'sport' => 'nullable|numeric|min:0|max:100',
        ]);

        // Calculate total and average
        $scores = array_filter($validated, fn($value) => $value !== null && $value !== '');
        $total = array_sum($scores);
        $average = count($scores) > 0 ? $total / count($scores) : 0;

        // Determine rank
        $rank = $this->calculateRank($average);

        // Prepare data for saving
        $dataToSave = [
            'student_id' => $studentId,
            'math' => $validated['math'] ?? null,
            'khmer' => $validated['khmer'] ?? null,
            'english' => $validated['english'] ?? null,
            'history' => $validated['history'] ?? null,
            'geography' => $validated['geography'] ?? null,
            'chemistry' => $validated['chemistry'] ?? null,
            'physics' => $validated['physics'] ?? null,
            'biology' => $validated['biology'] ?? null,
            'ethics' => $validated['morality'] ?? null,  // Map morality → ethics
            'sports' => $validated['sport'] ?? null,     // Map sport → sports
            'total' => $total,
            'average' => round($average, 2),
            'rank' => $rank,
        ];

        // ✅ Always create a new record
        $subject = Subject::create($dataToSave);

        // ✅ Log activity
        ActivityLogController::log(
            'add_scores',
            'Added new scores for student: ' . $student->user->name .
            ' (Average: ' . round($average, 2) . ', Rank: ' . $rank . ')',
            null,
            $subject->toArray()
        );

        return redirect()->route('subject.create', $studentId)
            ->with('success', 'ពិន្ទុថ្មីត្រូវបានរក្សាទុកដោយជោគជ័យ!');
    }

    /**
     * Calculate rank based on average score.
     */
    private function calculateRank($average)
    {
        return match (true) {
            $average >= 90 => 'A',
            $average >= 80 => 'B',
            $average >= 70 => 'C',
            $average >= 60 => 'D',
            $average >= 50 => 'E',
            default => 'F',
        };
    }

    /**
     * Show a specific student's scores.
     */
    public function show($studentId)
    {
        // Check permission
        $user = Auth::user();
        if (!$user || (! $user->hasPermission('view-scores') &&
            ! $user->hasRole('teacher') &&
            ! $user->hasRole('admin'))) {
            abort(403, 'អ្នកមិនមានសិទ្ធិមើលពិន្ទុទេ។');
        }

        $student = Student::with('user', 'subjects')->findOrFail($studentId);

        return view('subject.show', compact('student'));
    }

    /**
     * Delete a subject/scores (admins only).
     */
    public function destroy($subjectId)
    {
        // Only admins can delete scores
        $user = Auth::user();
        if (!$user || ! $user->hasRole('admin')) {
            abort(403, 'មានតែអ្នកគ្រប់គ្រងទេដែលអាចលុបពិន្ទុបាន។');
        }

        $subject = Subject::with('student.user')->findOrFail($subjectId);

        // Capture data before deletion
        $oldValues = $subject->toArray();
        $studentName = $subject->student->user->name ?? 'Unknown';

        $subject->delete();

        // Log activity
        ActivityLogController::log(
            'delete_scores',
            'Deleted scores for student: ' . $studentName,
            $oldValues,
            null
        );

        return redirect()->back()->with('success', 'ពិន្ទុត្រូវបានលុបដោយជោគជ័យ!');
    }
}
