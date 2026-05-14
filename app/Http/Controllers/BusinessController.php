<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role == 'admin') {
                $businesses = Business::all();
            } elseif ($user->role == 'owner') {
                $businesses = Business::where('owner_id', $user->id)->get();
            } else {
                $businesses = Business::all();
            }
        } else {
            $businesses = Business::all();
        }
        return view('businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && !auth()->user()->canCreateBusiness()) {
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
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && !auth()->user()->canCreateBusiness()) {
            return redirect()->route('businesses.index')
                ->with('error', 'Has alcanzado el límite de negocios de tu plan');
        }

        $business = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
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
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }
        $users = User::where('role', 'owner')->get();

        return view('businesses.edit', compact('business', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($business->image) {
                if (Storage::disk('public')->exists($business->image)) {
                    Storage::disk('public')->delete($business->image);
                }
            }

            $data['image'] = $request->file('image')->store('businesses', 'public');
        }

        $business->update($data);
        return redirect()->route('businesses.index')->with('success', 'Negocio actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        if (auth()->user()->role == 'client') {
            abort(403);
        }

        if (auth()->user()->role == 'owner' && $business->owner_id != auth()->id()) {
            abort(403);
        }

        if ($business->image) {
            if (Storage::disk('public')->exists($business->image)) {
                Storage::disk('public')->delete($business->image);
            }
        }

        $business->delete();

        return redirect()->route('businesses.index')
            ->with('success', 'Negocio eliminado correctamente');
    }
}
