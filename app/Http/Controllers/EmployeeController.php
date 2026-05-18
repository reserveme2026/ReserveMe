<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Business $business)
    {
        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        $employees = Employee::where('business_id', $business->id)->get();

        return view('employees.index', compact('business', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Business $business)
    {
        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('employees.create', compact('business'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Business $business)
    {
        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|regex:/^(\+34\s?)?[6789]\d{8}$/',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return back()->withInput()
                ->with('error', 'El empleado debe tener un usuario registrado con ese correo');
        }

        if ($user->role == 'admin' || $user->role == 'owner') {
            return back()->withInput()
                ->with('error', 'Ese correo pertenece a un usuario que no puede convertirse en empleado');
        }

        if ($user->role == 'client') {
            $user->update([
                'role' => 'employee',
            ]);
        }

        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['business_id'] = $business->id;

        Employee::create($data);

        return redirect()->route('businesses.employees.index', $business)
            ->with('success', 'Empleado creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business, Employee $employee)
    {
        if ($employee->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('employees.show', compact('business', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business, Employee $employee)
    {
        if ($employee->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('employees.edit', compact('business', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business, Employee $employee)
    {
        if ($employee->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'required|regex:/^(\+34\s?)?[6789]\d{8}$/',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return back()->withInput()
                ->with('error', 'El empleado debe tener un usuario registrado con ese correo');
        }

        if ($user->role == 'admin' || $user->role == 'owner') {
            return back()->withInput()
                ->with('error', 'Ese correo pertenece a un usuario que no puede convertirse en empleado');
        }

        if ($user->role == 'client') {
            $user->update([
                'role' => 'employee',
            ]);
        }

        $data['name'] = $user->name;
        $data['email'] = $user->email;

        $oldEmail = $employee->email;

        $employee->update($data);

        if ($oldEmail != $employee->email) {
            $oldUser = User::where('email', $oldEmail)->first();

            if ($oldUser && $oldUser->role == 'employee' && !Employee::where('email', $oldEmail)->exists()) {
                $oldUser->update([
                    'role' => 'client',
                    'owner_plan' => null,
                ]);
            }
        }

        return redirect()->route('businesses.employees.index', $business)
            ->with('success', 'Empleado actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business, Employee $employee)
    {
        if ($employee->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        $employeeEmail = $employee->email;

        $employee->delete();

        $user = User::where('email', $employeeEmail)->first();

        if ($user && $user->role == 'employee' && !Employee::where('email', $employeeEmail)->exists()) {
            $user->update([
                'role' => 'client',
                'owner_plan' => null,
            ]);
        }

        return redirect()->route('businesses.employees.index', $business)
            ->with('success', 'Empleado eliminado correctamente');
    }
}
