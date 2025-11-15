<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class DiagramController extends Controller
{
    public function index(): View
    {
        return view('diagram.index');
    }

    public function data(): JsonResponse
    {
        $dataset = Subject::with('exams')->get()->map(function (Subject $subject) {
            $attempts = $subject->exams->count() ?: 1;
            $total = $subject->exams->sum(fn ($exam) => $exam->oral_score + $exam->written_score);

            return [
                'subject' => $subject->name,
                'average' => round($total / $attempts, 2),
            ];
        });

        return response()->json($dataset);
    }
}
