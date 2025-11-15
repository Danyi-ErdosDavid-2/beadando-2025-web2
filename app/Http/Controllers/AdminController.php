<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Message;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard(): View
    {
        $stats = [
            'users' => User::count(),
            'messages' => Message::count(),
            'students' => Student::count(),
            'subjects' => Subject::count(),
            'exams' => Exam::count(),
        ];

        $users = User::orderBy('name')->get();

        return view('admin.dashboard', compact('stats', 'users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', 'in:registered,admin'],
        ]);

        $user->update(['role' => $data['role']]);

        return redirect()->route('admin.dashboard')->with('status', 'Felhasználói szerep frissítve.');
    }
}
