<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role != 'admin') {
    abort(403);
}

        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role != 'admin') {
    abort(403);
}

        $user = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'role' => 'required|in:owner,client'
        ]);

        $user['password'] = Hash::make($user['password']);
        User::create($user);
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (auth()->user()->role != 'admin') {
    abort(403);
}

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (auth()->user()->role != 'admin') {
    abort(403);
}

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->role != 'admin') {
    abort(403);
}

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:owner,client'
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:4|confirmed'
            ]);

            $user['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->user()->role != 'admin') {
    abort(403);
}

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado');
    }
    public function requestOwner()
    {
        if (auth()->user()->role != 'client') {
            abort(403);
        }

        $user = auth()->user();

        $user->update([
            'owner_request_status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Solicitud enviada correctamente');
    }

    public function approveOwner(User $user)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $user->update([
            'role' => 'owner',
            'owner_request_status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Solicitud aprobada correctamente');
    }

    public function rejectOwner(User $user)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $user->update([
            'owner_request_status' => 'rejected',
        ]);

        return redirect()->back()->with('success', 'Solicitud rechazada correctamente');
    }
}
