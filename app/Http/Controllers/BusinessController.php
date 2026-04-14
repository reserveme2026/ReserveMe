<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = Business::all();
        return view('businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'owner')->get();
        return view('businesses.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $business = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        $business['owner_id'] = auth()->id();
        Business::create($business);
        return redirect()->route('businesses.index')->with('success', 'Negocio creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        return view('business.show', compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        $users = User::all();
        return view('businesses.edit', compact('business', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'owner_id' => 'required'
        ]);
        $business->update($data);
        return redirect()->route('businesses.index')->with('success', 'Negocio actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $business->delete();
        return redirect()->route('businesses.index')->with('success','Negocio eliminado');
    }
}
