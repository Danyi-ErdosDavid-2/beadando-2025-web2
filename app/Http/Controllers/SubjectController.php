<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->middleware('role:admin')->except('index');
    }

    public function index(): View
    {
        $subjects = Subject::withCount('exams')->orderBy('name')->paginate(10);

        return view('subjects.index', compact('subjects'));
    }

    public function create(): View
    {
        return view('subjects.create');
    }

    public function store(SubjectRequest $request): RedirectResponse
    {
        Subject::create($request->validated());

        return redirect()->route('subjects.index')->with('status', 'Vizsgatárgy sikeresen létrehozva.');
    }

    public function edit(Subject $subject): View
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(SubjectRequest $request, Subject $subject): RedirectResponse
    {
        $subject->update($request->validated());

        return redirect()->route('subjects.index')->with('status', 'Vizsgatárgy frissítve.');
    }

    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('status', 'Vizsgatárgy törölve.');
    }
}
