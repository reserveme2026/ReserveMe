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
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $businesses = Business::where('owner_id', auth()->id())->get();
        return view('employees.create', compact('businesses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = $request->validate([
            'name'=> 'required|string|max:100',
            'email'=> 'required|email',
            'phone'=> 'string|max:20',
            'business_id' => 'required|exists:businesses,id',
        ]);
        Employee::create($employee);
        return redirect()->route('employees.index')->with('success','Empleado creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $businesses = Business::where('owner_id', auth()->id())->get();
        return view('employees.edit', compact('employee','businesses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name'=> 'required|string|max:100',
            'email'=> 'required|email',
            'phone'=> 'string|max:20',
            'business_id' => 'required|exists:businesses,id',
        ]);
        $employee->update($data);
        return redirect()->route('employees.index')->with('success','Empleado actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Empleado eliminado');
    }
}
