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
            'ninos' => 'nullable|integer|min:0',
        ]);

        $habitacion = Habitacion::findOrFail($request->habitacion_id);

        // Validar capacidad
        $totalPersonas = $request->adultos + $request->ninos;
        if ($totalPersonas > $habitacion->capacidad) {
            return redirect()->back()->withErrors([
                'capacidad' => 'La habitación solo admite ' . $habitacion->capacidad . ' personas.'
            ])->withInput();
        }

        // Validar fechas no empalmadas
        $traslape = Reservacion::where('habitacion_id', $request->habitacion_id)
            ->where(function($query) use ($request) {
                $query->where('fecha_inicio', '<', $request->fecha_fin)
                      ->where('fecha_fin', '>', $request->fecha_inicio);
            })
            ->exists();

        if ($traslape) {
            return redirect()->back()->withErrors([
                'fecha' => 'La habitación ya está reservada en esas fechas.'
            ])->withInput();
        }

        // Calcular total
        $dias = (new \Carbon\Carbon($request->fecha_inicio))
                  ->diffInDays(new \Carbon\Carbon($request->fecha_fin));

        $total = $dias * $habitacion->precio;

        Reservacion::create([
            'user_id' => auth()->id(),
            'habitacion_id' => $request->habitacion_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'adultos' => $request->adultos,
            'ninos' => $request->ninos,
            'total' => $total,
        ]);

        return redirect()->route('reservaciones.index')
            ->with('success', 'Reservación creada correctamente.');
    }

    public function edit(Reservacion $reservacion)
    {
        $habitaciones = Habitacion::all();
        
        return view('reservaciones.edit', compact('reservacion', 'habitaciones'));
    }

    public function update(Request $request, Reservacion $reservacion)
    {
        $request->validate([
            'habitacion_id' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'adultos' => 'required|integer|min:1',
            'ninos' => 'nullable|integer|min:0',
            'estado' => 'required'
        ]);

        $reservacion->update($request->all());

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