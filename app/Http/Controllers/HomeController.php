<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'students' => Student::count(),
            'subjects' => Subject::count(),
            'exams' => Exam::count(),
        ];

        $topSubjects = Subject::withCount('exams')
            ->orderByDesc('exams_count')
            ->take(3)
            ->get();

        $topResults = Exam::with(['student', 'subject'])
            ->select('*', DB::raw('(oral_score + written_score) as total_points'))
            ->orderByDesc('total_points')
            ->take(5)
            ->get();

        return view('home', compact('stats', 'topSubjects', 'topResults'));
    }
}
