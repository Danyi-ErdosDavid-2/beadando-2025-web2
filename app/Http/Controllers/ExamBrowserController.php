<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamBrowserController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'subject' => ['nullable', 'integer', 'exists:subjects,id'],
            'classroom' => ['nullable', 'string', 'max:10'],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $query = Exam::with(['student', 'subject']);

        if ($validated['subject'] ?? null) {
            $query->where('subject_id', $validated['subject']);
        }

        if ($validated['classroom'] ?? null) {
            $query->whereHas('student', fn ($q) => $q->where('classroom', $validated['classroom']));
        }

        if ($validated['search'] ?? null) {
            $term = $validated['search'];
            $query->whereHas('student', fn ($q) => $q->where('name', 'like', '%' . $term . '%'));
        }

        $exams = $query->orderByDesc(DB::raw('oral_score + written_score'))
            ->paginate(20)
            ->withQueryString();

        $subjects = Subject::orderBy('name')->get();

        return view('exams.index', compact('exams', 'subjects'));
    }
}
