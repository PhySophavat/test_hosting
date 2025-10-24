<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;

class RankController extends Controller
{
    /**
     * Show dynamic rank for a given class with optional month filter.
     */
    public function index(Request $request, $className)
    {
        $month = $request->input('month');
        $year = $request->input('year', date('Y'));

        $students = Student::with('user')
            ->where('grade', $className)
            ->get();

        // Count gender
        $maleCount = $students->filter(function($student) {
            $gender = strtolower($student->gender ?? '');
            return in_array($gender, ['male', 'ប្រុស', 'm', '1', 'boy', 'ប្រុស']);
        })->count();

        $femaleCount = $students->filter(function($student) {
            $gender = strtolower($student->gender ?? '');
            return in_array($gender, ['female', 'ស្រី', 'f', '2', 'girl', 'ស្រី']);
        })->count();

        if ($students->isEmpty()) {
            return view('rank.index', [
                'className' => $className,
                'rankedStudents' => collect(),
                'stats' => [
                    'total_students' => 0,
                    'male_count' => 0,
                    'female_count' => 0,
                    'students_with_scores' => 0,
                    'highest_score' => 0,
                    'lowest_score' => 0,
                    'average_score' => 0,
                    'top_student' => null,
                    'has_scores' => false,
                ],
                'selectedMonth' => $month,
                'selectedYear' => $year,
            ]);
        }

        $subjectsQuery = Subject::whereIn('student_id', $students->pluck('id'));

        if ($month) {
            $subjectsQuery->whereMonth('created_at', $month)
                          ->whereYear('created_at', $year);
        } else {
            $subjectsQuery->whereIn('id', function($query) use ($students) {
                $query->selectRaw('MAX(id)')
                      ->from('subjects')
                      ->whereIn('student_id', $students->pluck('id'))
                      ->groupBy('student_id');
            });
        }

        $subjects = $subjectsQuery->get()->keyBy('student_id');

        $scores = $students->map(function($student) use ($subjects) {
            $subject = $subjects->get($student->id);

            if ($subject) {
                $subjectScores = [
                    $subject->math ?? 0,
                    $subject->khmer ?? 0,
                    $subject->english ?? 0,
                    $subject->history ?? 0,
                    $subject->geography ?? 0,
                    $subject->chemistry ?? 0,
                    $subject->physics ?? 0,
                    $subject->biology ?? 0,
                    $subject->ethics ?? 0,
                    $subject->sports ?? 0,
                ];

                $total = array_sum($subjectScores);
                $average = $subject->average ?? 0;

                return [
                    'student' => $student,
                    'total' => (float)$total,
                    'average' => (float)$average,
                    'subject' => $subject,
                    'has_score' => $total > 0,
                ];
            }

            return [
                'student' => $student,
                'total' => 0,
                'average' => 0,
                'subject' => null,
                'has_score' => false,
            ];
        });

        $sorted = $scores->sortByDesc('total')->values();

        $ranked = collect();
        $currentRank = 0;
        $lastTotal = null;

        foreach ($sorted as $index => $row) {
            if ($lastTotal === null || $row['total'] !== $lastTotal) {
                $currentRank = $index + 1;
                $lastTotal = $row['total'];
            }
            $row['rank'] = $currentRank;
            $ranked->push($row);
        }

        $withScores = $ranked->filter(fn($r) => $r['has_score']);

        $stats = [
            'total_students' => $ranked->count(),
            'male_count' => $maleCount,
            'female_count' => $femaleCount,
            'students_with_scores' => $withScores->count(),
            'highest_score' => $withScores->max('total') ?? 0,
            'lowest_score' => $withScores->min('total') ?? 0,
            'average_score' => $withScores->avg('total') ?? 0,
            'top_student' => $withScores->first(),
            'has_scores' => $withScores->isNotEmpty(),
        ];

        return view('rank.index', [
            'className' => $className,
            'rankedStudents' => $ranked,
            'stats' => $stats,
            'selectedMonth' => $month,
            'selectedYear' => $year,
        ]);
    }
}