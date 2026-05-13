<?php

namespace App\Http\Controllers;

use App\Models\OwnerRequest;
use Illuminate\Http\Request;

class OwnerRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role != 'client' && auth()->user()->role != 'owner') {
            abort(403);
        }

        $user = auth()->user();

        $pendingRequest = OwnerRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingRequest) {
            return redirect()->route('ownerRequests.plans')
                ->with('error', 'Ya tienes una solicitud pendiente');
        }

        $data = $request->validate([
            'requested_plan' => 'required|in:starter,pro,premium',
        ]);

        if ($user->role == 'owner' && $user->owner_plan == $data['requested_plan']) {
            return redirect()->route('ownerRequests.plans')
                ->with('error', 'Ya tienes ese plan activo');
        }

        $requestedPlanLimit = $this->getPlanLimit($data['requested_plan']);

        if ($user->role == 'owner' && $user->businesses()->count() > $requestedPlanLimit) {
            return redirect()->route('ownerRequests.plans')
                ->with('error', 'Para solicitar un plan inferior tienes que eliminar negocios hasta ajustarte al límite permitido');
        }

        OwnerRequest::create([
            'user_id' => $user->id,
            'requested_plan' => $data['requested_plan'],
            'status' => 'pending',
        ]);

        if ($user->role == 'owner') {
            return redirect()->route('businesses.index')
                ->with('success', 'Solicitud de actualización de plan enviada correctamente');
        }

        return redirect()->route('businesses.index')
            ->with('success', 'Solicitud enviada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function plans()
    {
        if (auth()->user()->role != 'client' && auth()->user()->role != 'owner') {
            abort(403);
        }

        $pendingRequest = OwnerRequest::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        return view('ownerRequests.plans', compact('pendingRequest'));
    }

    public function approve(OwnerRequest $ownerRequest)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        if ($ownerRequest->status != 'pending') {
            return redirect()->route('users.index')
                ->with('error', 'Esta solicitud ya fue revisada');
        }

        $requestedPlanLimit = $this->getPlanLimit($ownerRequest->requested_plan);

        if ($ownerRequest->user->role == 'owner' && $ownerRequest->user->businesses()->count() > $requestedPlanLimit) {
            return redirect()->route('users.index')
                ->with('error', 'No se puede aprobar este cambio de plan porque el usuario supera el límite de negocios del plan solicitado');
        }

        $ownerRequest->user->update([
            'role' => 'owner',
            'owner_plan' => $ownerRequest->requested_plan,
        ]);

        $ownerRequest->update([
            'status' => 'approved',
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Solicitud aprobada correctamente');
    }

    public function reject(OwnerRequest $ownerRequest)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        if ($ownerRequest->status != 'pending') {
            return redirect()->route('users.index')
                ->with('error', 'Esta solicitud ya fue revisada');
        }

        $ownerRequest->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Solicitud rechazada correctamente');
    }

    public function leaveOwner()
    {
        $user = auth()->user();

        if ($user->role != 'owner') {
            abort(403);
        }

        if ($user->businesses()->count() > 0) {
            return redirect()->route('businesses.index')
                ->with('error', 'No puedes dejar de ser owner mientras tengas negocios creados');
        }

        $user->update([
            'role' => 'client',
            'owner_plan' => null,
        ]);

        return redirect()->route('businesses.index')
            ->with('success', 'Has dejado de ser owner correctamente');
    }

    private function getPlanLimit($plan)
    {
        if ($plan == 'starter') {
            return 1;
        }

        if ($plan == 'pro') {
            return 3;
        }

        if ($plan == 'premium') {
            return 6;
        }

        return null;
    }
}
