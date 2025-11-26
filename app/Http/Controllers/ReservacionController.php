<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservacionController extends Controller
{
    public function index()
    {
        $reservaciones = Reservacion::with(['habitacion', 'usuario'])->get();
        return view('reservaciones.index', compact('reservaciones'));
    }

    public function create()
    {
        $habitaciones = Habitacion::where('estado', 'disponible')->get();
        return view('reservaciones.create', compact('habitaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'adultos' => 'required|integer|min:1',
            'ninos' => 'nullable|integer|min:0'
        ]);

        Reservacion::create([
            'user_id' => Auth::id(),
            'habitacion_id' => $request->habitacion_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'adultos' => $request->adultos,
            'ninos' => $request->ninos ?? 0,
            'estado' => 'pendiente'
        ]);

        return redirect()->route('reservaciones.index')
                        ->with('success', 'Reservación creada correctamente.');
    }

    public function edit(Reservacion $reservacione)
    {
        $habitaciones = Habitacion::all();
        return view('reservaciones.edit', [
            'reservacion' => $reservacione,
            'habitaciones' => $habitaciones
        ]);
    }

    public function update(Request $request, Reservacion $reservacione)
    {
        $request->validate([
            'habitacion_id' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'adultos' => 'required|integer|min:1',
            'ninos' => 'nullable|integer|min:0',
            'estado' => 'required'
        ]);

        $reservacione->update($request->all());

        return redirect()->route('reservaciones.index')
                        ->with('success', 'Reservación actualizada.');
    }

    public function destroy(Reservacion $reservacione)
    {
        $reservacione->delete();

        return redirect()->route('reservaciones.index')
                        ->with('success', 'Reservación eliminada.');
    }
}
