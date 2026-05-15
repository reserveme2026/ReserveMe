<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Business::query();

        if (auth()->check()) {
            if (auth()->user()->role == 'owner') {
                $query->where('owner_id', auth()->id());
            }

            if (auth()->user()->role == 'employee') {
                $query->whereHas('employees', function ($q) {
                    $q->where('email', auth()->user()->email);
                });
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $businesses = $query->get();

        return view('businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if (!auth()->user()->canCreateBusiness()) {
            return redirect()->route('businesses.index')
                ->with('error', 'Has alcanzado el límite de negocios de tu plan');
        }

        return view('businesses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if (!auth()->user()->canCreateBusiness()) {
            return redirect()->route('businesses.index')
                ->with('error', 'Has alcanzado el límite de negocios de tu plan');
        }

        $business = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'required|regex:/^(\+34\s?)?[6789]\d{8}$/',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:businesses,email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $business['image'] = $request->file('image')->store('businesses', 'public');
        }

        $business['owner_id'] = auth()->id();

        $business = Business::create($business);

        return redirect()->route('businesses.show', $business)
            ->with('success', 'Negocio creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        return view('businesses.show', compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        return view('businesses.edit', compact('business'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        if (auth()->user()->role != 'owner') {
            abort(403);
        }

        if ($business->owner_id != auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:255',
            'phone' => 'required|regex:/^(\+34\s?)?[6789]\d{8}$/',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:businesses,email,' . $business->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($business->image && Storage::disk('public')->exists($business->image)) {
                Storage::disk('public')->delete($business->image);
            }

            $data['image'] = $request->file('image')->store('businesses', 'public');
        }

        $business->update($data);

        return redirect()->route('businesses.index')
            ->with('success', 'Negocio actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        if (auth()->user()->role != 'owner' && auth()->user()->role != 'admin') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        if ($business->image && Storage::disk('public')->exists($business->image)) {
            Storage::disk('public')->delete($business->image);
        }

        $business->delete();

        return redirect()->route('businesses.index')
            ->with('success', 'Negocio eliminado correctamente');
    }
}
