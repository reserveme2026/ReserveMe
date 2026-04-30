<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Business $business)
    {
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
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
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('employees.create', compact('business'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Business $business)
    {
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        $employee = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:20',
        ]);

        $employee['business_id'] = $business->id;

        Employee::create($employee);

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

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
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

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
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

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'required|string|max:20',
        ]);

        $employee->update($data);

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

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        $employee->delete();

        return redirect()->route('businesses.employees.index', $business)
            ->with('success', 'Empleado eliminado correctamente');
    }
}
