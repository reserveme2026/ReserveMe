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
    public function index(Business $business)
    {
        $user = auth()->user();

        if ($user->role == 'client') {
            $appointments = Appointment::where('business_id', $business->id)
                ->where('user_id', $user->id)
                ->get();
        } elseif ($user->role == 'owner') {
            if ($business->owner_id != $user->id) {
                abort(403);
            }

            $appointments = Appointment::where('business_id', $business->id)->get();
        } else {
            $appointments = Appointment::where('business_id', $business->id)->get();
        }

        return view('appointments.index', compact('business', 'appointments'));
    }

    public function create(Business $business)
    {
        if (auth()->user()->role != 'client') {
            return redirect()->route('businesses.appointments.index', $business)
                ->with('error', 'Tienes que ser un cliente para hacer una reserva');
        }

        $employees = Employee::where('business_id', $business->id)->get();
        $services = Service::where('business_id', $business->id)->get();

        return view('appointments.create', compact('business', 'employees', 'services'));
    }

    public function store(Request $request, Business $business)
    {
        if (auth()->user()->role != 'client') {
            return redirect()->route('businesses.appointments.index', $business)
                ->with('error', 'Tienes que ser un cliente para hacer una reserva');
        }

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:255',
        ]);

        $employee = Employee::where('id', $request->employee_id)
            ->where('business_id', $business->id)
            ->firstOrFail();

        $service = Service::where('id', $request->service_id)
            ->where('business_id', $business->id)
            ->firstOrFail();

        $start = Carbon::parse($request->appointment_date . ' ' . $request->time);
        $end = $start->copy()->addMinutes($service->duration_minutes);

        if ($this->hasOverlap($employee->id, $request->appointment_date, $start, $end)) {
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
            'appointment_date' => $request->appointment_date,
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'status' => 'pending',
            'service_name' => $service->name,
            'service_duration_minutes' => $service->duration_minutes,
            'service_price' => $service->price,
            'notes' => $request->notes,
        ]);

        return redirect()->route('businesses.appointments.index', $business)
            ->with('success', 'Cita creada correctamente');
    }

    public function show(Business $business, Appointment $appointment)
    {
        if ($appointment->business_id != $business->id) {
            abort(404);
        }

        $user = auth()->user();

        if ($user->role == 'client' && $appointment->user_id != $user->id) {
            abort(403);
        }

        if ($user->role == 'owner' && $business->owner_id != $user->id) {
            abort(403);
        }

        return view('appointments.show', compact('business', 'appointment'));
    }

    public function edit(Business $business, Appointment $appointment)
    {
        if ($appointment->business_id != $business->id) {
            abort(404);
        }

        $user = auth()->user();

        if ($user->role == 'client' && $appointment->user_id != $user->id) {
            abort(403);
        }

        if ($user->role == 'owner' && $business->owner_id != $user->id) {
            abort(403);
        }

        $employees = Employee::where('business_id', $business->id)->get();
        $services = Service::where('business_id', $business->id)->get();

        return view('appointments.edit', compact('business', 'appointment', 'employees', 'services'));
    }


    public function update(Request $request, Business $business, Appointment $appointment)
    {
        if ($appointment->business_id != $business->id) {
            abort(404);
        }

        $user = auth()->user();

        if ($user->role == 'client' && $appointment->user_id != $user->id) {
            abort(403);
        }

        if ($user->role == 'owner' && $business->owner_id != $user->id) {
            abort(403);
        }

        $rules = [
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:255',
        ];

        if ($user->role == 'owner' || $user->role == 'admin') {
            $rules['status'] = 'required|in:pending,confirmed,cancelled';
        }

        $request->validate($rules);

        $employee = Employee::where('id', $request->employee_id)
            ->where('business_id', $business->id)
            ->firstOrFail();

        $service = Service::where('id', $request->service_id)
            ->where('business_id', $business->id)
            ->firstOrFail();

        $start = Carbon::parse($request->appointment_date . ' ' . $request->time);
        $end = $start->copy()->addMinutes($service->duration_minutes);

        $overlap = Appointment::where('employee_id', $employee->id)
            ->where('appointment_date', $request->appointment_date)
            ->where('id', '!=', $appointment->id)
            ->where('status', '!=', 'cancelled')
            ->where('start_time', '<', $end->format('H:i:s'))
            ->where('end_time', '>', $start->format('H:i:s'))
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

        $data = [
            'employee_id' => $employee->id,
            'service_id' => $service->id,
            'appointment_date' => $request->appointment_date,
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'service_name' => $service->name,
            'service_duration_minutes' => $service->duration_minutes,
            'service_price' => $service->price,
            'notes' => $request->notes,
        ];

        if ($user->role == 'owner' || $user->role == 'admin') {
            $data['status'] = $request->status;
        }

        if ($user->role == 'client') {
            $data['status'] = 'pending';
        }

        $appointment->update($data);

        return redirect()->route('businesses.appointments.index', $business)
            ->with('success', 'Cita actualizada correctamente');
    }

    public function destroy(Business $business, Appointment $appointment)
    {
        if ($appointment->business_id != $business->id) {
            abort(404);
        }

        $user = auth()->user();

        if ($user->role == 'client' && $appointment->user_id != $user->id) {
            abort(403);
        }

        if ($user->role == 'owner' && $business->owner_id != $user->id) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('businesses.appointments.index', $business)
            ->with('success', 'Cita eliminada correctamente');
    }

    public function confirm(Business $business, Appointment $appointment)
    {
        if ($appointment->business_id != $business->id) {
            abort(404);
        }

        $user = auth()->user();

        if ($user->role == 'client') {
            abort(403);
        }

        if ($user->role == 'owner' && $business->owner_id != $user->id) {
            abort(403);
        }

        $appointment->update([
            'status' => 'confirmed',
        ]);

        return redirect()->route('businesses.appointments.index', $business)
            ->with('success', 'Cita aceptada correctamente');
    }

    public function reject(Business $business, Appointment $appointment)
    {
        if ($appointment->business_id != $business->id) {
            abort(404);
        }

        $user = auth()->user();

        if ($user->role == 'client') {
            abort(403);
        }

        if ($user->role == 'owner' && $business->owner_id != $user->id) {
            abort(403);
        }

        $appointment->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('businesses.appointments.index', $business)
            ->with('success', 'Cita rechazada correctamente');
    }

    public function cancel(Business $business, Appointment $appointment)
    {
        if ($appointment->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role != 'client' || $appointment->user_id != auth()->id()) {
            abort(403);
        }

        $appointment->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('businesses.appointments.index', $business)
            ->with('success', 'Cita cancelada correctamente');
    }

    private function hasOverlap($employeeId, $date, $start, $end)
    {
        return Appointment::where('employee_id', $employeeId)
            ->where('appointment_date', $date)
            ->where('status', '!=', 'cancelled')
            ->where('start_time', '<', $end->format('H:i:s'))
            ->where('end_time', '>', $start->format('H:i:s'))
            ->exists();
    }

    private function inSchedule($employee, $start, $end)
    {
        $dayOfWeek = $start->dayOfWeek;

        $schedules = Schedule::where('employee_id', $employee->id)
            ->where('day_of_week', $dayOfWeek)
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
        $blockedTimes = BlockedTime::where('employee_id', $employee->id)
            ->where('block_date', $start->toDateString())
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

    public function myAppointments()
    {
        if (auth()->user()->role != 'client') {
            abort(403);
        }

        $appointments = Appointment::where('user_id', auth()->id())
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->get();

        return view('appointments.myAppointments', compact('appointments'));
    }
}
