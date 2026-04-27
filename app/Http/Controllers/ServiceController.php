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
    public function index(Business $business)
    {
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        $services = Service::where('business_id', $business->id)->get();

        return view('services.index', compact('business', 'services'));
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

        return view('services.create', compact('business'));
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

        $service = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:255',
            'duration_minutes' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $service['business_id'] = $business->id;

        Service::create($service);

        return redirect()->route('businesses.services.index', $business)
            ->with('success', 'Servicio creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business, Service $service)
    {
        if ($service->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('services.show', compact('business', 'service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business, Service $service)
    {
        if ($service->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('services.edit', compact('business', 'service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business, Service $service)
    {
        if ($service->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:255',
            'duration_minutes' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $service->update($data);

        return redirect()->route('businesses.services.index', $business)
            ->with('success', 'Servicio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business, Service $service)
    {
        if ($service->business_id != $business->id) {
            abort(404);
        }

        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        $service->delete();

        return redirect()->route('businesses.services.index', $business)
            ->with('success', 'Servicio eliminado correctamente');
    }
}
