<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $businesses = Business::all();
        return view('services.create', compact('businesses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = $request->validate([
            'name'=> 'required|string|max:100',
            'description'=> 'string|max:255',
            'duration_minutes'=> 'required|integer',
            'price'=> 'required|numeric',
            'business_id' => 'required|exists:businesses,id',
        ]);
        Service::create($service);
        return redirect()->route('services.index')->with('success','Servicio creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $businesses = Business::all();
        return view('services.edit', compact('service', 'businesses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'=> 'required|string|max:100',
            'description'=> 'string|max:255',
            'duration_minutes'=> 'required|integer',
            'price'=> 'required|numeric',
            'business_id' => 'required|exists:businesses,id',
        ]);
        $service->update($data);
        return redirect()->route('services.index')->with('success','Servicio actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success','Servicio eliminado');
    }
}
