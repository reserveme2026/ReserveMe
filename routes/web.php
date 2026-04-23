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


Route::get('/businesses/{business}/appointments/create', [AppointmentController::class, 'create'])
->name('business.appointments.create');
Route::post('/businesses/{business}/appointments', [AppointmentController::class, 'store'])
->name('business.appointments.store');
Route::resource('employees.schedules', ScheduleController::class);
Route::resource('employees.blocked-times', BlockedTimeController::class);

Route::resource('appointments', AppointmentController::class)->except(['create','store']);
Route::resource('businesses', BusinessController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('services', ServiceController::class);
Route::resource('users', UserController::class);
Route::resource('employees.schedules', ScheduleController::class);
Route::resource('employees.blocked-times', BlockedTimeController::class);
