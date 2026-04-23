<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        $user = auth()->user();

        if ($user->role != 'admin' && $employee->business->owner_id != $user->id) {
            abort(403);
        }

        $schedules = Schedule::where('employee_id', $employee->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return view('schedules.index', compact('employee', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employee $employee)
    {
        $user = auth()->user();

        if ($user->role != 'admin' && $employee->business->owner_id != $user->id) {
            abort(403);
        }

        return view('schedules.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Employee $employee)
    {
        $user = auth()->user();

        if ($user->role != 'admin' && $employee->business->owner_id != $user->id) {
            abort(403);
        }

        $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Schedule::create([
            'employee_id' => $employee->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('employees.schedules.index', $employee)
            ->with('success', 'Horario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();

        if ($schedule->employee_id != $employee->id) {
            abort(404);
        }

        if ($user->role != 'admin' && $employee->business->owner_id != $user->id) {
            abort(403);
        }

        return view('schedules.edit', compact('employee', 'schedule'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee, Schedule $schedule)
    {
        $user = auth()->user();

        if ($schedule->employee_id != $employee->id) {
            abort(404);
        }

        if ($user->role != 'admin' && $employee->business->owner_id != $user->id) {
            abort(403);
        }

        return view('schedules.edit', compact('employee', 'schedule'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee, Schedule $schedule)
    {
        $user = auth()->user();

        if ($schedule->employee_id != $employee->id) {
            abort(404);
        }

        if ($user->role != 'admin' && $employee->business->owner_id != $user->id) {
            abort(403);
        }

        $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule->update([
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('employees.schedules.index', $employee)
            ->with('success', 'Horario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, Schedule $schedule)
    {
        $user = auth()->user();

        if ($schedule->employee_id != $employee->id) {
            abort(404);
        }

        if ($user->role != 'admin' && $employee->business->owner_id != $user->id) {
            abort(403);
        }

        $schedule->delete();

        return redirect()->route('employees.schedules.index', $employee)
            ->with('success', 'Horario eliminado correctamente');
    }
}
