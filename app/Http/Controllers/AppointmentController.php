<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Business;
use App\Models\Employee;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('appointments.create', compact('businesses', 'employees', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
