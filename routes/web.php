<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\ExamBrowserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/adatbazis', [ExamBrowserController::class, 'index'])->name('exams.index');

Route::get('/kapcsolat', [ContactController::class, 'create'])->name('contact.form');
Route::post('/kapcsolat', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'role:registered,admin'])->group(function () {
    Route::get('/uzenetek', [MessageController::class, 'index'])->name('messages.index');
});

Route::middleware('auth')->group(function () {
    Route::post('/kijelentkezes', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/bejelentkezes', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/bejelentkezes', [AuthController::class, 'login'])->name('login.store');

    Route::get('/regisztracio', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/regisztracio', [AuthController::class, 'register'])->name('register.store');
});

Route::get('/diagram', [DiagramController::class, 'index'])->name('diagram.index');
Route::get('/diagram/adatok', [DiagramController::class, 'data'])->name('diagram.data');

Route::resource('subjects', SubjectController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->parameters(['subjects' => 'subject']);

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::patch('/admin/users/{user}', [AdminController::class, 'updateRole'])->name('admin.users.update');
