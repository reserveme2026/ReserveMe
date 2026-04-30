<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
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
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('schedules.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Employee $employee)
    {
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        $schedule = $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule['employee_id'] = $employee->id;

        Schedule::create($schedule);

        return redirect()->route('employees.schedules.index', $employee)
            ->with('success', 'Horario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, Schedule $schedule)
    {
        if ($schedule->employee_id != $employee->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('schedules.show', compact('employee', 'schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee, Schedule $schedule)
    {
        if ($schedule->employee_id != $employee->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('schedules.edit', compact('employee', 'schedule'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee, Schedule $schedule)
    {
        if ($schedule->employee_id != $employee->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule->update($data);

        return redirect()->route('employees.schedules.index', $employee)
            ->with('success', 'Horario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, Schedule $schedule)
    {
        if ($schedule->employee_id != $employee->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        $schedule->delete();

        return redirect()->route('employees.schedules.index', $employee)
            ->with('success', 'Horario eliminado correctamente');
    }
}
