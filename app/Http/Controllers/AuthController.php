<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegisterForm(): View
    {
        abort_unless(config('app.allow_registration'), 403, 'A regisztráció ideiglenesen le van tiltva.');

        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        abort_unless(config('app.allow_registration'), 403);

        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_REGISTERED,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('status', 'Sikeres regisztráció, üdv a VizsgaPortálon!');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Hibás belépési adatok.'])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'Sikeresen kijelentkeztél.');
    }
}
