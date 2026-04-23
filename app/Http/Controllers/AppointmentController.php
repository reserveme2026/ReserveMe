<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\BlockedTime;
use App\Models\Business;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'admin') {
            $appointments = Appointment::all();
        } elseif ($user->role == 'owner') {
            $businesses = Business::where('owner_id', '=', $user->id)->pluck('id');
            $appointments = Appointment::whereIn('business_id', $businesses)->get();
        } else {
            $appointments = Appointment::where('user_id', '=', $user->id)->get();
        }
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Business $business)
    {
        if (auth()->user()->role != 'client') {
            return redirect()->route('appointments.index')
                ->with('error', 'Tienes que ser un cliente para hacer una reserva');
        }

        $employees = Employee::where('business_id', $business->id)->get();
        $services = Service::where('business_id', $business->id)->get();

        return view('appointments.create', compact('business', 'employees', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Business $business)
    {
        if (auth()->user()->role != 'client') {
            return redirect()->route('appointments.index')
                ->with('error', 'Tienes que ser un cliente para hacer una reserva');
        }

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'nullable|string|max:255',
        ]);
        $employee = Employee::where('id', $request->employee_id)
            ->where('business_id', $business->id)
            ->firstOrFail();

        $service = Service::where('id', $request->service_id)
            ->where('business_id', $business->id)
            ->firstOrFail();

        $start = Carbon::parse($request->date . ' ' . $request->time);
        $end = $start->copy()->addMinutes($service->duration_minutes);
        if ($this->hasOverlap($employee->id, $request->date, $start, $end)) {
            return back()->withInput()
                ->with('error', 'Ese empleado ya tiene una cita en ese horario');
        }
        if (!$this->inSchedule($employee, $start, $end)) {
            return back()->withInput()
                ->with('error', 'La cita está fuera del horario del empleado');
        }
        if ($this->hasBlock($employee, $start, $end)) {
            return back()->withInput()
                ->with('error', 'El empleado no está disponible en ese horario');
        }
        Appointment::create([
            'user_id' => Auth::id(),
            'business_id' => $business->id,
            'employee_id' => $employee->id,
            'service_id' => $service->id,
            'date' => $request->date,
            'start_time' => $start,
            'end_time' => $end,
            'status' => 'pending',
            'service_name' => $service->name,
            'duration' => $service->duration_minutes,
            'price' => $service->price,

            'description' => $request->description,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Cita creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $user = auth()->user();

        if ($user->role == 'client' && $appointment->user_id != $user->id) {
            abort(403);
        }

        if ($user->role == 'owner' && $appointment->business->owner_id != $user->id) {
            abort(403);
        }

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $user = auth()->user();

        if ($user->role == 'client' && $appointment->user_id != $user->id) {
            abort(403);
        }

        if ($user->role == 'owner' && $appointment->business->owner_id != $user->id) {
            abort(403);
        }

        $business = $appointment->business;

        $employees = Employee::where('business_id', $business->id)->get();
        $services = Service::where('business_id', $business->id)->get();

        return view('appointments.edit', compact('appointment', 'business', 'employees', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $user = auth()->user();

        if ($user->role == 'client' && $appointment->user_id != $user->id) {
            abort(403);
        }

        if ($user->role == 'owner' && $appointment->business->owner_id != $user->id) {
            abort(403);
        }

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|in:pending,confirmed,cancelled',
            'description' => 'nullable|string|max:255',
        ]);

        $business = $appointment->business;

        $employee = Employee::where('id', $request->employee_id)
            ->where('business_id', $business->id)
            ->firstOrFail();

        $service = Service::where('id', $request->service_id)
            ->where('business_id', $business->id)
            ->firstOrFail();

        $start = Carbon::parse($request->date . ' ' . $request->time);
        $end = $start->copy()->addMinutes($service->duration_minutes);

        $overlap = Appointment::where('employee_id', $employee->id)
            ->where('date', $request->date)
            ->where('id', '!=', $appointment->id)
            ->where('start_time', '<', $end)
            ->where('end_time', '>', $start)
            ->exists();

        if ($overlap) {
            return back()->withInput()
                ->with('error', 'Ese empleado ya tiene una cita en ese horario');
        }

        if (!$this->inSchedule($employee, $start, $end)) {
            return back()->withInput()
                ->with('error', 'La cita está fuera del horario del empleado');
        }

        if ($this->hasBlock($employee, $start, $end)) {
            return back()->withInput()
                ->with('error', 'El empleado no está disponible en ese horario');
        }

        $appointment->update([
            'employee_id' => $employee->id,
            'service_id' => $service->id,
            'date' => $request->date,
            'start_time' => $start,
            'end_time' => $end,
            'status' => $request->status,
            'service_name' => $service->name,
            'duration' => $service->duration_minutes,
            'price' => $service->price,
            'description' => $request->description,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Cita actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $user = auth()->user();

        if ($user->role == 'client' && $appointment->user_id != $user->id) {
            abort(403);
        }

        if ($user->role == 'owner' && $appointment->business->owner_id != $user->id) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Cita eliminada correctamente');
    }

    private function hasOverlap($employeeId, $date, $start, $end)
    {
        $appointments = Appointment::where('employee_id', $employeeId)->where('date', $date)
            ->get();
        foreach ($appointments as $appointment) {
            if ($start < $appointment->end_time && $end > $appointment->start_time) {
                return true;
            }
        }
        return false;
    }

    private function inSchedule($employee, $start, $end)
    {
        $dayOfWeek = $start->dayOfWeek;
        $schedules = Schedule::where('employee_id', $employee->id)->where('day_of_week', $dayOfWeek)
            ->get();
        foreach ($schedules as $schedule) {
            $scheduleStart = Carbon::parse($start->toDateString() . ' ' . $schedule->start_time);
            $scheduleEnd = Carbon::parse($start->toDateString() . ' ' . $schedule->end_time);
            if ($start >= $scheduleStart && $end <= $scheduleEnd) {
                return true;
            }
        }
        return false;
    }

    private function hasBlock($employee, $start, $end)
    {
        $blockedTimes = BlockedTime::where('employee_id', $employee->id)->where('date', $start->toDateString())
            ->get();

        foreach ($blockedTimes as $blockedTime) {
            $blockedStart = Carbon::parse($start->toDateString() . ' ' . $blockedTime->start_time);
            $blockedEnd = Carbon::parse($start->toDateString() . ' ' . $blockedTime->end_time);
            if ($start < $blockedEnd && $end > $blockedStart) {
                return true;
            }
        }
        return false;
    }
}
