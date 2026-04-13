<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/businesses');
});
Route::resource('appointments', AppointmentController::class);
Route::resource('businesses', BusinessController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('services', AppointmentController::class);
Route::resource('users', UserController::class);
