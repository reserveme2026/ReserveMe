<?php

namespace App\Http\Controllers;

use App\Models\BlockedTime;
use App\Models\Employee;
use Illuminate\Http\Request;

class BlockedTimeController extends Controller
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

        $blockedTimes = BlockedTime::where('employee_id', $employee->id)
            ->orderBy('block_date')
            ->orderBy('start_time')
            ->get();

        return view('blockedTimes.index', compact('employee', 'blockedTimes'));
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

        return view('blockedTimes.create', compact('employee'));
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


        $request->validate([
            'block_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'reason' => 'nullable|string|max:255',
        ]);

        BlockedTime::create([
            'employee_id' => $employee->id,
            'block_date' => $request->block_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'reason' => $request->reason,
        ]);

        return redirect()->route('employees.blockedTimes.index', $employee)
            ->with('success', 'Bloqueo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, BlockedTime $blockedTime)
    {
        if ($blockedTime->employee_id != $employee->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('blockedTimes.show', compact('employee', 'blockedTime'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee, BlockedTime $blockedTime)
    {
        if ($blockedTime->employee_id != $employee->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('blockedTimes.edit', compact('employee', 'blockedTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee, BlockedTime $blockedTime)
    {
        if ($blockedTime->employee_id != $employee->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }


        $request->validate([
            'block_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'reason' => 'nullable|string|max:255',
        ]);

        $blockedTime->update([
            'block_date' => $request->block_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'reason' => $request->reason,
        ]);

        return redirect()->route('employees.blockedTimes.index', $employee)
            ->with('success', 'Bloqueo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, BlockedTime $blockedTime)
    {
        if ($blockedTime->employee_id != $employee->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $employee->business->owner_id != auth()->id()) {
            abort(403);
        }

        $blockedTime->delete();

        return redirect()->route('employees.blockedTimes.index', $employee)
            ->with('success', 'Bloqueo eliminado correctamente');
    }
}
