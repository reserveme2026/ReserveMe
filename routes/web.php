<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlockedTimeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OwnerRequestController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/businesses');
});

Route::get('/businesses', [BusinessController::class, 'index'])->name('businesses.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role == 'admin') {
            return redirect()->route('businesses.index');
        }

        if ($user->role == 'owner') {
            return redirect()->route('businesses.index');
        }

        if ($user->role == 'client') {
            return redirect()->route('businesses.index');
        }

        if ($user->role == 'employee') {
            return redirect()->route('businesses.index');
        }

        abort(403);
    })->name('dashboard');

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada correctamente');
    })->name('logout');

    Route::resource('businesses', BusinessController::class)->except(['index']);

    Route::resource('businesses.services', ServiceController::class);
    Route::resource('businesses.employees', EmployeeController::class);
    Route::get('/businesses/{business}/appointments/available-times', [AppointmentController::class, 'availableTimes'])
        ->name('businesses.appointments.availableTimes');
    Route::resource('businesses.appointments', AppointmentController::class);

    Route::resource('employees.schedules', ScheduleController::class);
    Route::resource('employees.blockedTimes', BlockedTimeController::class);

    Route::resource('users', UserController::class);

    Route::patch('/businesses/{business}/appointments/{appointment}/confirm', [AppointmentController::class, 'confirm'])
        ->name('businesses.appointments.confirm');

    Route::patch('/businesses/{business}/appointments/{appointment}/reject', [AppointmentController::class, 'reject'])
        ->name('businesses.appointments.reject');
    Route::patch('/businesses/{business}/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])
        ->name('businesses.appointments.cancel');

    Route::get('/my-appointments', [AppointmentController::class, 'myAppointments'])
        ->name('appointments.myAppointments');

    Route::get('/owner-plans', [OwnerRequestController::class, 'plans'])
        ->name('ownerRequests.plans');

    Route::post('/owner-requests', [OwnerRequestController::class, 'store'])
        ->name('ownerRequests.store');

    Route::post('/owner-requests/{ownerRequest}/approve', [OwnerRequestController::class, 'approve'])
        ->name('ownerRequests.approve');

    Route::post('/owner-requests/{ownerRequest}/reject', [OwnerRequestController::class, 'reject'])
        ->name('ownerRequests.reject');

    Route::delete('/owner-membership', [OwnerRequestController::class, 'leaveOwner'])
        ->name('ownerRequests.leaveOwner');
});
