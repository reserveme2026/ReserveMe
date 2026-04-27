<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlockedTimeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/businesses');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role == 'admin') {
            return view('dashboard', compact('user'));
        }

        if ($user->role == 'owner') {
            return redirect()->route('businesses.index');
        }

        if ($user->role == 'client') {
            return redirect()->route('appointments.index');
        }

        abort(403);
    })->name('dashboard');

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada correctamente');
    })->name('logout');

    Route::resource('businesses', BusinessController::class);

    Route::resource('employees', EmployeeController::class);

    Route::resource('services', ServiceController::class);

    Route::get('/businesses/{business}/appointments/create', [AppointmentController::class, 'create'])
        ->name('appointments.create');

    Route::post('/businesses/{business}/appointments', [AppointmentController::class, 'store'])
        ->name('appointments.store');

    Route::resource('appointments', AppointmentController::class)->except(['create', 'store']);

    Route::resource('employees.schedules', ScheduleController::class);

    Route::resource('employees.blockedTimes', BlockedTimeController::class);

    Route::post('/owner-request', [UserController::class, 'requestOwner'])
        ->name('users.requestOwner');

    Route::post('/users/{user}/approve-owner', [UserController::class, 'approveOwner'])
        ->name('users.approveOwner');

    Route::post('/users/{user}/reject-owner', [UserController::class, 'rejectOwner'])
        ->name('users.rejectOwner');

    Route::resource('users', UserController::class);
});