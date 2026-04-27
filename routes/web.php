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

    Route::resource('businesses.services', ServiceController::class);

    Route::resource('businesses.employees', EmployeeController::class);

    Route::resource('businesses.appointments', AppointmentController::class);

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