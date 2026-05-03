<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TrainerAssignmentController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;

/* public */

Route::get('/', function () {
    return view('welcome');
});

/* dashboard */

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/* profile */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* trainer */

Route::middleware(['auth', 'role:trainer'])
    ->prefix('trainer')
    ->name('trainer.')
    ->group(function () {
        Route::get('/members', [TrainerController::class, 'members'])->name('members');
        Route::get('/attendance', [TrainerController::class, 'attendance'])->name('attendance');
        Route::get('/profile', [TrainerController::class, 'profile'])->name('profile');
    });

/* members */

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::resource('members', MemberController::class);
});

/* trainers */

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers.index');
    Route::get('/trainers/create', [TrainerController::class, 'create'])->name('trainers.create');
    Route::post('/trainers', [TrainerController::class, 'store'])->name('trainers.store');
    Route::get('/trainers/{trainer}', [TrainerController::class, 'show'])->name('trainers.show');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/trainers/{trainer}/edit', [TrainerController::class, 'edit'])->name('trainers.edit');
    Route::put('/trainers/{trainer}', [TrainerController::class, 'update'])->name('trainers.update');
    Route::delete('/trainers/{trainer}', [TrainerController::class, 'destroy'])->name('trainers.destroy');
});

/* trainer assignments */

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/trainer-assignments', [TrainerAssignmentController::class, 'index'])->name('trainer-assignments.index');
    Route::get('/trainer-assignments/create', [TrainerAssignmentController::class, 'create'])->name('trainer-assignments.create');
    Route::post('/trainer-assignments', [TrainerAssignmentController::class, 'store'])->name('trainer-assignments.store');
    Route::get('/trainer-assignments/{id}', [TrainerAssignmentController::class, 'show'])->name('trainer-assignments.show');
});

/* membership plans */

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/plans', [MembershipPlanController::class, 'index'])->name('plans.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/plans/create', [MembershipPlanController::class, 'create'])->name('plans.create');
    Route::post('/plans', [MembershipPlanController::class, 'store'])->name('plans.store');
    Route::get('/plans/{plan}/edit', [MembershipPlanController::class, 'edit'])->name('plans.edit');
    Route::put('/plans/{plan}', [MembershipPlanController::class, 'update'])->name('plans.update');
    Route::delete('/plans/{plan}', [MembershipPlanController::class, 'destroy'])->name('plans.destroy');
});

/* payments */

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
});

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
});

/* attendance */

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/{id}', [AttendanceController::class, 'show'])->name('attendance.show');
    Route::put('/attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
});

Route::get('/debug-error', function () {
    try {
        \DB::connection()->getPdo();
        $db = 'connected';
    } catch (\Exception $e) {
        $db = $e->getMessage();
    }
    return response()->json([
        'db' => $db,
        'env' => app()->environment(),
        'key' => config('app.key') ? 'set' : 'missing',
        'log' => file_exists(storage_path('logs/laravel.log'))
            ? file_get_contents(storage_path('logs/laravel.log'))
            : 'no log file',
    ]);
});


/* auth */

require __DIR__ . '/auth.php';